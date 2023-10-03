<?php

namespace App\Http\Integrations\Planfix\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class GetSftpAccount extends Request implements HasBody
{
    use HasJsonBody;
    /**
     * Define the HTTP method
     *
     * @var Method
     */
    protected Method $method = Method::POST;
    protected string $url;


    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * Define the endpoint for the request
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return '/directory/22376/entry/list';
    }

    protected function defaultBody(): array
    {
        return [
            "offset" => 0,
            "pageSize" => 100,
            "fields" => "ddirectory,parentKey,name,key,10,52064,52068,52070,52066",
            "filters" => [
                [
                    "type" => 6101,
                    "field" => 52064,
                    "operator" => "equal",
                    "value" => $this->url
                ]
            ]
        ];
    }
}
