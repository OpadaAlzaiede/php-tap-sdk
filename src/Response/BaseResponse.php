<?php

declare(strict_types=1);

namespace Obadaalzidi\TapPhpSdk\Response;

class BaseResponse
{
    protected array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function id(): string
    {
        return $this->data['id'];
    }

    public function status(): string
    {
        return $this->data['status'];
    }

    public function amount(): float
    {
        return $this->data['amount'];
    }

    public function currency(): string
    {
        return $this->data['currency'];
    }

    public function rawData(): array
    {
        return $this->data;
    }
}
