<?php

declare(strict_types=1);

namespace Obadaalzidi\TapPhpSdk\Api;

use Obadaalzidi\TapPhpSdk\Http\HttpClient;
use Obadaalzidi\TapPhpSdk\Response\BaseResponse;

abstract class BaseApi
{
    protected HttpClient $httpClient;

    protected string $endpoint;

    protected string $responseClass;

    /**
     * BaseApi constructor.
     */
    public function __construct(HttpClient $httpClient, string $endpoint, string $responseClass)
    {
        $this->httpClient = $httpClient;
        $this->endpoint = $endpoint;
        $this->responseClass = $responseClass;
    }

    /**
     * Create a new resource.
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->httpClient->post($this->endpoint, $data);

        return new ($this->responseClass)($response);
    }

    /**
     * Retrieve a resource.
     */
    public function retrieve(string $id): BaseResponse
    {
        $response = $this->httpClient->get("{$this->endpoint}/{$id}");

        return new ($this->responseClass)($response);
    }

    /**
     * Update a resource.
     */
    public function update(string $id, array $data): BaseResponse
    {
        $response = $this->httpClient->put("{$this->endpoint}/{$id}", $data);

        return new ($this->responseClass)($response);
    }

    /**
     * List all resources.
     */
    public function list(array $data = []): array
    {
        $response = $this->httpClient->post($this->endpoint, $data);

        return array_map(fn ($item) => new ($this->responseClass)($item), $response['data'] ?? []);
    }

    /**
     * Download a resource.
     */
    public function download(array $data = []): array
    {
        $response = $this->httpClient->post($this->endpoint, $data);

        return $response;
    }
}
