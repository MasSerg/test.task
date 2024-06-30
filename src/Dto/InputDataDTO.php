<?php

declare(strict_types=1);

namespace TestTask\Dto;

/**
 * InputDataDTO
 *
 * transform array to object
 */
class InputDataDTO
{
    private int $bin;
    private float $amount;
    private string $currency;

    public static function fromArray(array $data): self
    {
        $self = new self();

        $self->bin = (int)$data['bin'] ?? 0;
        $self->amount = (float)$data['amount'] ?? 0;
        $self->currency = (string)$data['currency'] ?? '';

        return $self;
    }

    public function getBin(): int
    {
        return $this->bin;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }
}