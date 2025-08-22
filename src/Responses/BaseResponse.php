<?php

declare(strict_types=1);

namespace Obadaalzidi\TapPhpSdk\Responses;

class BaseResponse
{
    protected array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function id(): ?string
    {
        return $this->data['id'] ?? null;
    }

    public function status(): ?string
    {
        return $this->data['status'] ?? null;
    }

    public function amount(): ?float
    {
        return $this->data['amount'] ?? null;
    }

    public function currency(): ?string
    {
        return $this->data['currency'] ?? null;
    }

    public function rawData(): array
    {
        return $this->data;
    }
}
