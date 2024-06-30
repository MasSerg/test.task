<?php

declare(strict_types=1);

namespace TestTask\Contracts;

interface ContentServiceInterface
{
    public function processContent(string $inputFile): array;
}