<?php

declare(strict_types=1);

namespace TestTask\CustomErrorHandlers;

/**
 * ErrorHandler class
 *
 * Print error message in a console
 * should be rewritten to custom exception for the specific framework
 */
readonly class ErrorHandler
{
    public function __construct(
        private string $message = '',
        private int    $code = 0
    ) {
    }

    public function render(): void
    {
        echo "\n" . "Error: $this->code $this->message" ."\n";

        die();
    }
}