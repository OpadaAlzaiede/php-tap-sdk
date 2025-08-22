<?php
declare(strict_types=1);

namespace Obadaalzidi\TapPhpSdk\Utils;

class Webhook
{
    public static function verify(string $payload, string $signature, string $secret): bool
    {
        $expected = hash_hmac('sha256', $payload, $secret);
        return hash_equals($expected, $signature);
    }
}
