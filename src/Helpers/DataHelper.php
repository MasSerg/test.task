<?php

declare(strict_types=1);

namespace TestTask\Helpers;

use TestTask\Enums\CountriesEnum;
use TestTask\Enums\CurrencyEnum;

/**
 * DataHelper
 *
 * Helper - separate methods for reuse (if necessary)
 */
class DataHelper
{
    public static function isEU($c): bool
    {
        return (in_array($c, CountriesEnum::EU));
    }

    public static function isEuro(string $currency): bool
    {
        return $currency == CurrencyEnum::CURRENCY_EURO;
    }
}