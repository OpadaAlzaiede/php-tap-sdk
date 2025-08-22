<?php

namespace Tests\Unit\Http;

use GuzzleHttp\Psr7\Response;
use Obadaalzidi\TapPhpSdk\Exceptions\TapException;
use Obadaalzidi\TapPhpSdk\Exceptions\AuthenticationException;

it('performs a GET request', function () {
    $http = makeHttpClient([new Response(200, [], json_encode(['id' => 'ch_123']))]);
    $result = $http->get('charges/ch_123');
    expect($result['id'])->toBe('ch_123');
});

it('throws AuthenticationException on 401', function () {
    $http = makeHttpClient([new Response(401, [], json_encode(['errors' => [['description' => 'Invalid key']]]))]);
    $http->get('charges/ch_123');
})->throws(AuthenticationException::class);

it('throws TapException on other client errors', function () {
    $http = makeHttpClient([new Response(400, [], json_encode(['errors' => [['description' => 'Bad Request']]]))]);
    $http->post('charges', []);
})->throws(TapException::class);