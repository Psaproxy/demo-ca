<?php

declare(strict_types=1);

namespace Core\Common\Props;

use Core\Common\Exceptions\InvalidArgumentException;

class Price
{
    private Amount $amount;
    private Currency $currency;

    public function __construct(Amount $amount, Currency $currency = null)
    {
        if (0 > $amount) {
            throw new InvalidArgumentException(
                "Неверная сумма цены {$amount->value()}. Доступные значения 0 и более."
            );
        }

        $this->amount = $amount;
        $this->currency = null === $currency ? new CurrencyDefault() : $currency;
    }

    public function amount(): Amount
    {
        return $this->amount;
    }

    public function currency(): Currency
    {
        return $this->currency;
    }

    public function equals(Price $comparableValue): bool
    {
        return true === $this->amount->equals($comparableValue->amount())
            && true === $this->currency->equals($comparableValue->currency());
    }
}
