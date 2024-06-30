<?php

declare(strict_types=1);

namespace TestTask\Contracts;

interface ContentRepositoryInterface
{
    public function getInputData(string $url): array;

    public function getBinList($value): array;

    public function getExchangeRate(): array;
}