<?php
namespace App\MyChecks;

use Exception;
use Spatie\ServerMonitor\CheckDefinitions\CheckDefinition;
use Spatie\ServerMonitor\Models\Enums\CheckStatus;
use Symfony\Component\Process\Process;
use Spatie\SslCertificate\SslCertificate;


class SslCheck extends CheckDefinition
{


    public $command = '';

    public function resolve(Process $process)
    {
        $certificate = SslCertificate::createForHostName($this->check->host->name);
        $certIssuer = $certificate->getIssuer();
        $certValid = $certificate->isValid();
        $certExpireDate = $certificate->expirationDate()->format('d/m/Y');
        $resultToJson = json_encode([
            'certIssuer' => $certIssuer,
            'certValid' => $certValid ? 'Да' : 'Нет',
            'certExpireDate' => $certExpireDate
        ]);
        if ($certValid) {
            $this->check->succeed($resultToJson);
            return;
        }
        $this->check->fail('false');
    }

    public function determineResult(Process $process)
    {
        $this->check->storeProcessOutput($process);
        $this->resolve($process);
    }

    public function performNextRunInMinutes(): int
    {
        if ($this->check->hasStatus(CheckStatus::SUCCESS)) {
            return 1440;
        }
        return 1440;
    }

}

