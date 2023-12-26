<?php

namespace Core\Promotions\Common\Props;

use Core\Common\Props\Amount;
use Core\Common\Exceptions\InvalidArgumentException;

class ProgressAmount extends Amount
{
    public function __construct(float $value = null)
    {
        if (null !== $value && 0 > $value) {
            throw new InvalidArgumentException(
                "Недоступная сумма прогресса $value. Доступная сумма от 0 и больше.",
                400
            );
        }

        parent::__construct($value);
    }
}
