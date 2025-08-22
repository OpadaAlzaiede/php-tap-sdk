<?php

declare(strict_types=1);

namespace Obadaalzidi\TapPhpSdk;

use Psr\Http\Client\ClientInterface;
use Obadaalzidi\TapPhpSdk\Api\Charge;
use Obadaalzidi\TapPhpSdk\Api\Refund;
use Obadaalzidi\TapPhpSdk\Api\Authorize;
use Obadaalzidi\TapPhpSdk\Http\HttpClient;

class Tap
{
    protected HttpClient $httpClient;

    /**
     * Tap constructor.
     */
    public function __construct(
        string $secretKey,
        ?ClientInterface $client = null,
    )
    {
        $client ??= new \GuzzleHttp\Client();
        $this->httpClient = new HttpClient($secretKey, $client);
    }

    /**
     * Proxy to the Authorize API.
     */
    public function authorize(): Authorize
    {
        return new Authorize($this->httpClient);
    }

    /**
     * Proxy to the Charge API.
     */
    public function charges(): Charge
    {
        return new Charge($this->httpClient);
    }

    /**
     * Proxy to the Refund API.
     */
    public function refunds(): Refund
    {
        return new Refund($this->httpClient);
    }
}
