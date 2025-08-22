<?php
use Obadaalzidi\TapPhpSdk\Exceptions\AuthenticationException;
use Obadaalzidi\TapPhpSdk\Exceptions\TapException;

it('creates tap exceptions', function () {
    $ex = new TapException('oops');
    expect($ex)->toBeInstanceOf(Exception::class);

    $auth = new AuthenticationException('invalid');
    expect($auth)->toBeInstanceOf(TapException::class);
});
