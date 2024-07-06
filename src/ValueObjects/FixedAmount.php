<?php

declare(strict_types=1);

namespace TestTask\ValueObjects;

use TestTask\Enums\CurrencyCoefficientsEnum;
use TestTask\Helpers\DataHelper;

/**
 * FixedAmount
 *
 * fixed amount calculation
 */
final class FixedAmount
{
    private float $fixedAmount;

    public function __construct(
        private readonly float $rate,
        private readonly string $binCurrency,
        private readonly string $currency,
        private readonly float $amount
    ) {
    }

    /**
     * FixedAmountBuilder
     *
     * @return $this
     */
    public function fixedAmountBuilder(): FixedAmount
    {
        if (DataHelper::isEuro($this->currency) || $this->rate == 0) {
            $this->fixedAmount = $this->amount;
        }

        if ($this->rate > 0) {
            $this->fixedAmount = $this->amount / $this->rate;
        }

        return $this;
    }

    /**
     * CalculateFixedAmountWithCurrencyCoefficient
     *
     * @return $this
     */
    public function calculateFixedAmountWithCurrencyCoefficient(): FixedAmount
    {
        $this->fixedAmount = $this->fixedAmount * (DataHelper::isEu($this->binCurrency)
            ? CurrencyCoefficientsEnum::EURO_COEFFICIENT
            : CurrencyCoefficientsEnum::NO_EURO_COEFFICIENT);

        return $this;
    }

    /**
     * GetFixedAmount
     *
     * @return float
     */
    public function getFixedAmount(): float
    {
        return round($this->fixedAmount, 2);
    }
}
