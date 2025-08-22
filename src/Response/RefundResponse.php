<?php

declare(strict_types=1);

namespace Obadaalzidi\TapPhpSdk\Response;

class RefundResponse extends BaseResponse
{
    public function chargeId(): string
    {
        return $this->data['charge_id'];
    }
}
