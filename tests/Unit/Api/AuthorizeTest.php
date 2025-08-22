<?php
use Obadaalzidi\TapPhpSdk\Api\Authorize;
use Obadaalzidi\TapPhpSdk\Responses\AuthorizeResponse;
use GuzzleHttp\Psr7\Response;

it('voids an authorization', function () {
    $http = makeHttpClient([new Response(200, [], json_encode([
        'id' => 'auth_1', 'status' => 'voided', 'amount' => 100, 'currency' => 'KWD'
    ]))]);

    $api = new Authorize($http);
    $resp = $api->void('auth_1');

    expect($resp)->toBeInstanceOf(AuthorizeResponse::class);
    expect($resp->status())->toBe('voided');
});
