<?php

namespace App\Http\Controllers\ServerMonitor;


use App\Http\Controllers\Controller;
use App\Http\Integrations\Planfix\PlanfixConnector;
use App\Http\Integrations\Planfix\Requests\GetSftpAccount;
use App\Http\Requests\ServerMonitorRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Spatie\ServerMonitor\Models\Check;
use Spatie\ServerMonitor\Models\Enums\CheckStatus;
use Spatie\ServerMonitor\Models\Host;

class ServerMonitor extends Controller
{

    private function responsePlaceholder(){
        return [
            'result' => 'success',
            'url' => redirect()->back()->getTargetUrl()
        ];
    }

    public function show(Host $monitor)
    {
        $checks = $monitor->checks()->get()->keyBy('type');
        return view('ServerMonitor.detail', compact('monitor', 'checks'));
    }

    public function create($project)
    {
        $projecrUrlWithoutSchema = prepareUrlForUse($project->url);
        $monitor = $project->monitor;
        return view('ServerMonitor.form', compact('projecrUrlWithoutSchema', 'monitor', 'project'));
    }

    public function store(ServerMonitorRequest $request)
    {
        $data = $request->validated();
        unset($data["password"]);
        $fullData = $request->all();
        $project = Project::find($fullData['id']);
        $checks = array_keys(config('server-monitor.checks'));
        if(!Host::where('name', $data['name'])->first()) {
            Host::create($data)->checks()->saveMany(collect($checks)->map(function ($checkName) use ($fullData) {
                return new Check([
                    'type' => $checkName,
                    'status' => CheckStatus::NOT_YET_CHECKED,
                    'enabled' => isset($fullData[$checkName]) ? 1 : 0,
                    'custom_properties' => array_filter($fullData, function ($fieldValue, $key) use ($checkName)
                    {
                        return (strpos($key, $checkName . '_') !== false && $fieldValue != null);
                    }, ARRAY_FILTER_USE_BOTH ),
                ]);
            }));
            $project->monitor_id = Host::where('name', $data['name'])->first()->id;
            $project->save();
            return response()->json(
                $this->responsePlaceholder()
            );
        }else{
            return $this->jsonResponse = [
                'message' => ['Данный проект уже добавлен в мониторинг']
            ];
        }
    }

    public function edit(Host $monitor)
    {
        $projecrUrlWithoutSchema = $monitor->name;
        $monitor->load('checks');
        $ckecks = $monitor->checks->mapWithKeys(function ($check){
            return [$check['type'] => $check['enabled']];
        });
        return view('ServerMonitor.form', compact('monitor', 'ckecks', 'projecrUrlWithoutSchema'));
    }

    public function update(ServerMonitorRequest $request, Host $monitor)
    {
        $data = $request->validated();
        $fullData = $request->all();

        $checks = array_keys(config('server-monitor.checks'));
        $existChecks = $monitor->checks()->get()->pluck('id', 'type');
        $monitor->checks()->upsert(
            collect($checks)->map(function ($checkName) use ($fullData, $existChecks, $monitor) {
                return [
                    'id' => $existChecks[$checkName] ?? null,
                    'host_id' => $monitor->id,
                    'type' => $checkName,
                    'status' => CheckStatus::NOT_YET_CHECKED,
                    'enabled' => isset($fullData[$checkName]) ? 1 : 0,
                    'custom_properties' => json_encode(array_filter($fullData, function ($fieldValue, $key) use ($checkName)
                    {
                        return (strpos($key, $checkName . '_') !== false && $fieldValue != null);
                    }, ARRAY_FILTER_USE_BOTH )),
                ];
            })->toArray(), ['id'], ['enabled', 'custom_properties']
        );
        return response()->json(
            $this->responsePlaceholder()
        );
    }

    public function checkSshConnection(ServerMonitorRequest $request){
        $data = $request->validated();
        $ip = $data['ip'];
        $port = $data['port'];
        $username = $data['ssh_user'];
        $password = $data['password'];
        if($password){
            //  TODO Сделать проверку наличия ключа в файле authorized_keys прежде чем добавлять. Сейчас ключ может добавляться много раз
            system("sshpass -p ".$password." ssh  ".$username."@".$ip." 'mkdir -p ~/.ssh && touch ~/.ssh/authorized_keys'", $retval);
            system("cat ~/.ssh/id_rsa.pub | sshpass -p ".$password." ssh  ".$username."@".$ip." 'cat >> ~/.ssh/authorized_keys'", $retval2);
            if($retval2 != 0){
                return $this->ReturnErrorForAjax('Ошибка выполнения скрипта ssh-copy-id');
            }
        }
        $connection = ssh2_connect($ip, $port, array('hostkey' => 'ssh-rsa'));
        if (@ssh2_auth_pubkey_file($connection, $username, '/home/laravel/.ssh/id_rsa.pub', '/home/laravel/.ssh/id_rsa', 'secret')) {
            ssh2_disconnect($connection);
            unset($connection);
            return response()->json([
                'success' => '1',
            ]);
        } else {
            return $this->ReturnErrorForAjax('Ошибка при авторизации по ключу');
        }

    }

    private function ReturnErrorForAjax($errorText){
        return response()->json([
            'message' => [$errorText],
        ]);
    }
}
