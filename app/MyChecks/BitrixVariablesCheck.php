<?php
namespace App\MyChecks;

use Exception;
use Spatie\ServerMonitor\CheckDefinitions\CheckDefinition;
use Spatie\ServerMonitor\Models\Enums\CheckStatus;
use Symfony\Component\Process\Process;


class BitrixVariablesCheck extends CheckDefinition
{


    public $command;

    public function resolve(Process $process)
    {
        $status = $this->getCurlStatus($process->getOutput(), $process);
        if ($status) {
            $this->check->succeed($process->getOutput());
            return;
        }
    }

    public function command(): string
    {
        return 'curl https://'.$this->check->host->name.'/informer_statistic/ -H "Accept: application/json"';
    }

    public function determineResult(Process $process)
    {
        $this->check->storeProcessOutput($process);
        $this->resolve($process);
    }
    public function performNextRunInMinutes(): int
    {
        if ($this->check->hasStatus(CheckStatus::SUCCESS)) {
            return 20160;
        }
        return 20160;
    }
    protected function getCurlStatus(string $commandOutput, Process $process): int
    {
        if(!json_decode($commandOutput)) {
            $this->resolveFailed($process);
            return false;
        }
        return true;

    }
}

