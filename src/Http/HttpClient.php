<?php

namespace Obadaalzidi\TapPhpSdk\Http;

use GuzzleHttp\Client as GuzzleClient;
use Obadaalzidi\TapPhpSdk\Exceptions\TapException;
use Obadaalzidi\TapPhpSdk\Exceptions\AuthenticationException;

class HttpClient
{
    protected GuzzleClient $client;

    /**
     * HttpClient constructor.
     * 
     * @param string $secretKey
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
     * 
     * @param string $endpoint
     * @param array $query
     * 
     * @return array
     */
    public function get(string $endpoint, array $query = []): array
    {
        return $this->request('GET', $endpoint, ['query' => $query]);
    }

    /**
     * Post a resource.
     * 
     * @param string $endpoint
     * @param array $data
     * 
     * @return array
     */
    public function post(string $endpoint, array $data = []): array
    {
        return $this->request('POST', $endpoint, ['json' => $data]);
    }

    /**
     * Put a resource.
     * 
     * @param string $endpoint
     * @param array $data
     * 
     * @return array
     */
    public function put(string $endpoint, array $data = []): array
    {
        return $this->request('PUT', $endpoint, ['json' => $data]);
    }

    /**
     * Delete a resource.
     * 
     * @param string $endpoint
     * 
     * @return array
     */
    public function delete(string $endpoint): array
    {
        return $this->request('DELETE', $endpoint);
    }

    /**
     * Make a request to the API.
     * 
     * @param string $method
     * @param string $endpoint
     * @param array $options
     * 
     * @return array
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

            if ($statusCode ===  401) {
                throw new AuthenticationException($error);
            }

            throw new TapException($e->getMessage());
        }
    }
}