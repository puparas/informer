<?php
namespace App\MyChecks;

use Exception;
use Spatie\ServerMonitor\CheckDefinitions\CheckDefinition;
use Spatie\ServerMonitor\Models\Enums\CheckStatus;
use Symfony\Component\Process\Process;


class TextSearch extends CheckDefinition
{


    public $command;

    public function resolve(Process $process)
    {

        $result = array_map(function($item) {
            return explode(':', $item);
            },
            array_filter(explode(PHP_EOL, $process->getOutput())));
        if (is_array($result)) {
            $this->check->succeed(json_encode($result));
            return;
        }

        $this->check->fail('fail');
    }

    public function command(): string
    {
        $wgetPlaceholder = 'wget -q -O informer_search.html ';
        $grepPlaceholder = ' && grep -c %s informer_search.html';
        $sedPlaceholder = " | sed 's/^/%s:/'";
        $customCheckProp = $this->check->custom_properties;
        if(isset($customCheckProp["search_url"])) {
            $command = array_reduce(array_keys($customCheckProp["search_url"]), function ($carry, $item) use ($grepPlaceholder, $wgetPlaceholder, $customCheckProp, $sedPlaceholder) {
                $url = $customCheckProp["search_url"][$item];
                if ($url) {
                    $arrayNeedle = explode(',', $customCheckProp["search_text"][$item]);
                    $strGreps = array_reduce($arrayNeedle, function ($carryGreps, $itemGreps) use ($grepPlaceholder, $url, $sedPlaceholder) {
                        $itemGreps = trim($itemGreps);
                        return $carryGreps .= sprintf($grepPlaceholder, $itemGreps) . sprintf($sedPlaceholder, $itemGreps);
                    });
                    $carry .= $wgetPlaceholder . $url . $strGreps . ' && ';
                }
                return $carry;
            });
            return trim($command, ' && ');
        }else{
            return '0';
        }
    }

    public function performNextRunInMinutes(): int
    {
        if ($this->check->hasStatus(CheckStatus::SUCCESS)) {
            return 1440;
        }
        return 1440;
    }

}

