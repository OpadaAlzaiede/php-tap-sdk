<?php
use Obadaalzidi\TapPhpSdk\Api\Charge;
use Obadaalzidi\TapPhpSdk\Responses\ChargeResponse;
use GuzzleHttp\Psr7\Response;

it('creates a charge', function () {
    $http = makeHttpClient([new Response(200, [], json_encode([
        'id' => 'ch_123', 'status' => 'captured', 'amount' => 100, 'currency' => 'KWD'
    ]))]);

    $api = new Charge($http);
    $charge = $api->create(['amount' => 100]);

    expect($charge)->toBeInstanceOf(ChargeResponse::class);
    expect($charge->isCaptured())->toBeTrue();
});
