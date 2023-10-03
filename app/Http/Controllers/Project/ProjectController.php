<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Integrations\Planfix\PlanfixConnector;
use App\Http\Integrations\Planfix\Requests\GetBitrixAccount;
use App\Http\Integrations\Planfix\Requests\GetSftpAccount;
use App\Http\Requests\ProjectRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{

    private function responsePlaceholder($url=null){
        return [
            'result' => 'success',
            'url' => $url ?? redirect()->back()->getTargetUrl()
        ];
    }
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $user = Auth::user();
        $projectsCurrentUser = $user->projects()->get();
        $otherProjects = Project::withTrashed()
            ->whereNotIn('id', $projectsCurrentUser->pluck('id'))
            ->get()
            ->sortBy([['deleted_at', 'asc'], ['id', 'desc']]);
        $projects = $projectsCurrentUser->merge($otherProjects);
        return view('project.projects',compact('projects', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create(Request $request)
    {
        $curUser = Auth::user();
        $domain = $request->domain;
        $users = User::all();
        return view('project.form', compact('users', 'domain', 'curUser'));
    }

    /**
     * Store a newly created resource in storage.
     *

     */
    public function store(ProjectRequest $request)
    {
        $data = $request->validated();
        $users = $data['users'];
        unset($data['users']);
        $project= Project::create($data);
        $project->users()->sync($users);

        return response()->json(
            $this->responsePlaceholder(route('informer.show', $project->id))
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     */
    public function show(Project $project)
    {
        $user = Auth::user();
        $tabs = [
            'private'=>$project
                ->postsTrashed
                ->where('user_id', $user->id)
                ->where('role_id', '666')
                ->sortBy([['deleted_at', 'asc'], ['priority', 'desc'], ['id', 'desc']]),
            'user'=>$project
                ->postsTrashed
                ->where('role_id', '!=', 666)
                ->where('user_id', $user->id)
                ->sortBy([['deleted_at', 'asc'], ['priority', 'desc'], ['id', 'desc']]),
            'all' => $project
                ->posts
                ->where('role_id', '777')
                ->sortBy([['priority', 'desc'], ['id', 'desc']]),
        ];
        foreach ($user->roles->sortBy([['name', 'desc']]) as $role) {
            $tabs[$role->slug] = $project
                ->posts
                ->where('role_id', $role->id)
                ->sortBy([['priority', 'desc'], ['id', 'desc']]);
        }
        $projecrUrlWithoutSchema = prepareUrlForUse($project->url);
        return view('project.detail', compact('project', 'tabs', 'user', 'projecrUrlWithoutSchema'));
    }


    public function edit(Project $project)
    {

        $users = User::all();
        return view('project.form', compact('users', 'project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $data = $request->validated();
        $users = $data['users'];
        unset($data['users']);
        $project->update($data);
        $project->users()->sync($users);
        return response()->json(
            $this->responsePlaceholder()
        );
    }


    public function destroy(Project $project)
    {
        $project->delete();
        Post::where('project_id', $project->id)->delete();
        return response()->json(
            $this->responsePlaceholder(route('informer.index'))
        );
    }

    public function restore(Project $project)
    {
        $project->restore();
        Post::where('project_id', $project->id)->restore();
        return response()->json(
            $this->responsePlaceholder(route('informer.show', $project->id))
        );
    }
    public function chosen(Project $project){
        $users = $project->users->pluck('id');
        $user = Auth::user()->id;
        $project->users()->sync($users->push($user));
        return response()->json(
            $this->responsePlaceholder()
        );
    }
    public function getSftpAccount(Request $request){
        $url = $request->getContent();
        $response = resolve(GetSftpAccount::class, [$url])->body();
        if($response){
            $data = json_decode($response, true);
            return view('planfix.sftpaccount', compact('data'));
        }else{
            return $this->ReturnErrorForAjax('Ошибка Planfix API при получении данных');
        }
    }
    public function getAllAccounts(Request $request){
        $url = $request->getContent();
        $userIsProgrammist = (Auth::user()->hasRole('admin') || Auth::user()->hasRole('programmers'));
        $data['bitrix'] = json_decode(resolve(GetBitrixAccount::class, [$url])->body(),true);
        $data['sftp'] = $userIsProgrammist ?
            json_decode(resolve(GetSftpAccount::class, [$url])->body(), true)
            : '';
        if($data){
            return view('planfix.listAccounts', compact('data', 'url'));
        }else{
            return $this->ReturnErrorForAjax('Ошибка Planfix API при получении данных');
        }
    }

    private function ReturnErrorForAjax($errorText){
        return response()->json([
            'message' => [$errorText],
        ]);
    }
}
