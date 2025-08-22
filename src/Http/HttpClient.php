<?php

namespace Obadaalzidi\TapPhpSdk\Http;

use Obadaalzidi\TapPhpSdk\Exceptions\TapException;
use Obadaalzidi\TapPhpSdk\Exceptions\AuthenticationException;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;

class HttpClient
{
    /**
     * HttpClient constructor.
     */
    public function __construct(
        private string $secretKey,
        private ClientInterface $client,
    ) {
        //
    }

    /**
     * Get a resource.
     */
    public function get(string $endpoint, array $query = []): array
    {
        return $this->request('GET', $endpoint, ['query' => $query]);
    }

    /**
     * Post a resource.
     */
    public function post(string $endpoint, array $data = []): array
    {
        return $this->request('POST', $endpoint, ['json' => $data]);
    }

    /**
     * Put a resource.
     */
    public function put(string $endpoint, array $data = []): array
    {
        return $this->request('PUT', $endpoint, ['json' => $data]);
    }

    /**
     * Delete a resource.
     */
    public function delete(string $endpoint): array
    {
        return $this->request('DELETE', $endpoint);
    }

    /**
     * Make a request to the API.
     *
     *
     *
     * @throws TapException
     */
    protected function request(string $method, string $endpoint, ?array $options = []): array
    {
        try {
            $response = $this->client->request($method, $endpoint, $options);

            return json_decode($response->getBody(), true);
        } catch (ClientExceptionInterface $e) {
            $message = method_exists($e, 'getResponse') ? $e->getResponse()->getBody() : $e->getMessage();
            $statusCode = method_exists($e, 'getResponse') ? $e->getResponse()->getStatusCode() : $e->getCode();

            if ($statusCode === 401) {
                throw new AuthenticationException($message);
            }

            throw new TapException($e->getMessage());
        } catch (\Throwable $e) {
            throw new TapException("Unexpected error: {$e->getMessage()}", $e->getCode(), $e);
        }
    }
}
