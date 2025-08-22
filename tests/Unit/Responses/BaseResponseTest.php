<?php
use Obadaalzidi\TapPhpSdk\Responses\BaseResponse;

it('wraps data correctly', function () {
    $resp = new BaseResponse(['id' => 'x', 'status' => 'ok', 'amount' => 10, 'currency' => 'USD']);
    expect($resp->id())->toBe('x')
        ->and($resp->status())->toBe('ok')
        ->and($resp->amount())->toBe(10.0)
        ->and($resp->currency())->toBe('USD');
});
