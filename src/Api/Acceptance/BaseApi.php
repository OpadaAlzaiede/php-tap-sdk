<?php
declare(strict_types=1);

namespace Obadaalzidi\TapPhpSdk\Api\Acceptance;

use Obadaalzidi\TapPhpSdk\Http\HttpClient;
use Obadaalzidi\TapPhpSdk\Response\BaseResponse;

abstract class BaseApi
{
    protected HttpClient $httpClient;
    protected string $endpoint;
    protected string $responseClass;

    /**
     * BaseApi constructor.
     * 
     * @param HttpClient $httpClient
     * @param string $endpoint
     * @param string $responseClass
     */
    public function __construct(HttpClient $httpClient, string $endpoint, string $responseClass)
    {
        $this->httpClient = $httpClient;
        $this->endpoint = $endpoint;
        $this->responseClass = $responseClass;
    }

    /**
     * Create a new resource.
     * 
     * @param array $data
     * 
     * @return BaseResponse
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->httpClient->post($this->endpoint, $data);
        return new ($this->responseClass)($response);
    }

    /**
     * Retrieve a resource.
     * 
     * @param string $id
     * 
     * @return BaseResponse
     */
    public function retrieve(string $id): BaseResponse
    {
        $response = $this->httpClient->get("{$this->endpoint}/{$id}");
        return new ($this->responseClass)($response);
    }

    /**
     * Update a resource.
     * 
     * @param string $id
     * @param array $data
     * 
     * @return BaseResponse
     */
    public function update(string $id, array $data): BaseResponse
    {
        $response = $this->httpClient->put("{$this->endpoint}/{$id}", $data);
        return new ($this->responseClass)($response);
    }

    /**
     * List all resources.
     * 
     * @param array $data
     * 
     * @return array
     */
    public function list(array $data = []): array
    {
        $response = $this->httpClient->post($this->endpoint, $data);
        return array_map(fn($item) => new ($this->responseClass)($item), $response['data'] ?? []);
    }

    /**
     * Download a resource.
     * 
     * @param array $data
     * 
     * @return array
     */
    public function download(array $data = []): array
    {
        $response = $this->httpClient->post($this->endpoint, $data);
        return $response;
    }
}