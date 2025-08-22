<?php
use Obadaalzidi\TapPhpSdk\Responses\ChargeResponse;
use Obadaalzidi\TapPhpSdk\Enums\ChargeStatusEnum;

it('detects captured and authorized', function () {
    $resp = new ChargeResponse(['id' => 'c1', 'status' => ChargeStatusEnum::CAPTURED->value, 'amount' => 100, 'currency' => 'KWD']);
    expect($resp->isCaptured())->toBeTrue();
    expect($resp->isAuthorized())->toBeFalse();
});
