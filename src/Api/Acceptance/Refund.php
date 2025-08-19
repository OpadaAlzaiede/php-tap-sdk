<?php

declare(strict_types=1);

namespace Obadaalzidi\TapPhpSdk\Api\Acceptance;

use Obadaalzidi\TapPhpSdk\Http\HttpClient;
use Obadaalzidi\TapPhpSdk\Response\RefundResponse;


class Refund extends BaseApi
{
    /**
     * Refund constructor.
     * 
     * @param HttpClient $httpClient
     */
    public function __construct(protected HttpClient $httpClient)
    {
        parent::__construct($httpClient, 'refunds', RefundResponse::class);
    }
}