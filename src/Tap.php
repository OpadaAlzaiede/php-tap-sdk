<?php

declare(strict_types=1);

namespace Obadaalzidi\TapPhpSdk;

use Obadaalzidi\TapPhpSdk\Http\HttpClient;
use Obadaalzidi\TapPhpSdk\Api\Acceptance\Charge;
use Obadaalzidi\TapPhpSdk\Api\Acceptance\Refund;
use Obadaalzidi\TapPhpSdk\Api\Acceptance\Authorize;

class Tap
{
    protected HttpClient $httpClient;

    /**
     * Tap constructor.
     * 
     * @param string $secretKey
     */
    public function __construct(string $secretKey)
    {
        $this->httpClient = new HttpClient($secretKey);
    }

    /**
     * Proxy to the Authorize API.
     * 
     * @return Authorize
     */
    public function authorize(): Authorize
    {
        return new Authorize($this->httpClient);
    }

    /**
     * Proxy to the Charge API.
     * 
     * @return Charge
     */
    public function charges(): Charge
    {
        return new Charge($this->httpClient);
    }

    /**
     * Proxy to the Refund API.
     * 
     * @return Refund
     */
    public function refunds(): Refund
    {
        return new Refund($this->httpClient);
    }
}