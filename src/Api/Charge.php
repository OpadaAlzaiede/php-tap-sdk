<?php

declare(strict_types=1);

namespace Obadaalzidi\TapPhpSdk\Api;

use Obadaalzidi\TapPhpSdk\Http\HttpClient;
use Obadaalzidi\TapPhpSdk\Responses\ChargeResponse;

class Charge extends BaseApi
{
    /**
     * Charge constructor.
     */
    public function __construct(protected HttpClient $httpClient)
    {
        parent::__construct($httpClient, 'charges', ChargeResponse::class);
    }
}
