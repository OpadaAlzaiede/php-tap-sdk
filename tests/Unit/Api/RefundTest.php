<?php
use Obadaalzidi\TapPhpSdk\Api\Refund;
use Obadaalzidi\TapPhpSdk\Responses\RefundResponse;
use GuzzleHttp\Psr7\Response;

it('creates a refund', function () {
    $http = makeHttpClient([new Response(200, [], json_encode([
        'id' => 'rf_1', 'status' => 'succeeded', 'amount' => 100, 'currency' => 'KWD', 'charge_id' => 'ch_123'
    ]))]);

    $api = new Refund($http);
    $refund = $api->create(['charge_id' => 'ch_123']);

    expect($refund)->toBeInstanceOf(RefundResponse::class);
    expect($refund->chargeId())->toBe('ch_123');
});
