<?php
use Obadaalzidi\TapPhpSdk\Responses\RefundResponse;

it('returns charge id', function () {
    $resp = new RefundResponse(['id' => 'r1', 'status' => 'succeeded', 'amount' => 50, 'currency' => 'USD', 'charge_id' => 'c1']);
    expect($resp->chargeId())->toBe('c1');
});
