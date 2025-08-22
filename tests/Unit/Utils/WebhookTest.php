<?php

namespace Tests\Unit\Utils;

use Obadaalzidi\TapPhpSdk\Utils\Webhook;

it('verifies webhook signatures', function () {
    $payload = '{"id":"evt_1"}';
    $secret = 'whsec_test';
    $signature = hash_hmac('sha256', $payload, $secret);

    expect(Webhook::verify($payload, $signature, $secret))->toBeTrue();
    expect(Webhook::verify($payload, 'invalid', $secret))->toBeFalse();
});
