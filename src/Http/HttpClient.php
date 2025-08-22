<?php

namespace Obadaalzidi\TapPhpSdk\Http;

use GuzzleHttp\Client as GuzzleClient;
use Obadaalzidi\TapPhpSdk\Exceptions\AuthenticationException;
use Obadaalzidi\TapPhpSdk\Exceptions\TapException;

class HttpClient
{
    protected GuzzleClient $client;

    /**
     * HttpClient constructor.
     */
    public function __construct(string $secretKey)
    {
        $this->client = new GuzzleClient([
            'base_uri' => 'https://api.tap.company/v2/',
            'headers' => [
                'Authorization' => "Bearer $secretKey",
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);
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
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = json_decode($e->getResponse()->getBody(), true);
            $error = $response['errors'][0]['description'] ?? null;
            $statusCode = $e->getResponse()->getStatusCode();

            if ($statusCode === 401) {
                throw new AuthenticationException($error);
            }

            throw new TapException($e->getMessage());
        }
    }
}
