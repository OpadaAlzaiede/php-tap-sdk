<?php
use Obadaalzidi\TapPhpSdk\Responses\AuthorizeResponse;

it('can be constructed', function () {
    $resp = new AuthorizeResponse(['id' => 'a1', 'status' => 'authorized', 'amount' => 100, 'currency' => 'KWD']);
    expect($resp->id())->toBe('a1');
});
