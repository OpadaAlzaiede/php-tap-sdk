<?php

declare(strict_types=1);

namespace Obadaalzidi\TapPhpSdk\Api\Acceptance;

use Obadaalzidi\TapPhpSdk\Http\HttpClient;
use Obadaalzidi\TapPhpSdk\Response\AuthorizeResponse;

class Authorize extends BaseApi
{
    /**
     * Authorize constructor.
     * 
     * @param HttpClient $httpClient
     */
    public function __construct(protected HttpClient $httpClient)
    {
        parent::__construct($httpClient, 'authorize', AuthorizeResponse::class);
    }

    /**
     * Void an authorize resource.
     * 
     * @param string $authorizeId
     * 
     * @return AuthorizeResponse
     */
    public function void(string $authorizeId): AuthorizeResponse
    {
        $response = $this->httpClient->post("authorize/$authorizeId/void");

        return new AuthorizeResponse($response);
    }
}