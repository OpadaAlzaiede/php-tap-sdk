<?php
use Obadaalzidi\TapPhpSdk\Tap;
use Obadaalzidi\TapPhpSdk\Api\Charge;
use Obadaalzidi\TapPhpSdk\Api\Authorize;
use Obadaalzidi\TapPhpSdk\Api\Refund;

it('creates API clients', function () {
    $tap = new Tap('test_secret');

    expect($tap->charges())->toBeInstanceOf(Charge::class);
    expect($tap->authorize())->toBeInstanceOf(Authorize::class);
    expect($tap->refunds())->toBeInstanceOf(Refund::class);
});
