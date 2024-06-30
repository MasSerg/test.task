<?php

declare(strict_types=1);

namespace TestTask\Enums;

/**
 * CurrencyCoefficientsEnum
 *
 * Constants - coefficients for different countries, for those that are part of the EU and not
 */
enum CurrencyCoefficientsEnum
{
    public const float EURO_COEFFICIENT = 0.01;
    public const float NO_EURO_COEFFICIENT = 0.02;
}
