<?php

declare(strict_types=1);

namespace Obadaalzidi\TapPhpSdk\Enums;

enum ChargeStatusEnum: string
{
    case INITIATED = 'initiated';
    case AUTHORIZED = 'authorized';
    case CAPTURED = 'captured';
    case VOIDED = 'voided';
    case FAILED = 'failed';
}