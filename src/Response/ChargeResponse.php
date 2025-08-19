<?php

declare(strict_types=1);

namespace Obadaalzidi\TapPhpSdk\Response;

use Obadaalzidi\TapPhpSdk\Enums\ChargeStatusEnum;

class ChargeResponse extends BaseResponse
{
    public function isCaptured(): bool
    {
        return $this->data['status'] === ChargeStatusEnum::CAPTURED->value;
    }

    public function isAuthorized(): bool
    {
        return $this->data['status'] === ChargeStatusEnum::AUTHORIZED->value;
    }

    public function redirectUrl(): ?string
    {
        return $this->data['redirect']['url'] ?? null;
    }
}