<?php

namespace App\Http\Integrations\Planfix;

use Saloon\Contracts\Authenticator;
use Saloon\Contracts\Sender;
use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Connector;
use Saloon\Http\Senders\GuzzleSender;
use Saloon\Traits\Plugins\AcceptsJson;

class PlanfixConnector extends Connector
{
    use AcceptsJson;

    protected function defaultSender(): Sender
    {
        return resolve(GuzzleSender::class);
    }
    /**
     * The Base URL of the API
     *
     * @return string
     */
    public function resolveBaseUrl(): string
    {
        return config('services.planfix.url');
    }

    /**
     * Default headers for every request
     *
     * @return string[]
     */
    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json'
        ];
    }

    /**
     * Default HTTP client options
     *
     * @return string[]
     */
    protected function defaultConfig(): array
    {
        return [];
    }

    protected function defaultAuth(): ?Authenticator
    {
        return new TokenAuthenticator(config('services.planfix.token'), 'Bearer');
    }
}
