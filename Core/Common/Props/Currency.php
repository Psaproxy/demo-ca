<?php

declare(strict_types=1);

namespace Core\Common\Props;

use Core\Common\Exceptions\InvalidArgumentException;

class Currency extends Text
{
    public const USD = 'USD';
    public const ALL = [
        self::USD,
    ];

    public function __construct(string $value)
    {
        $value = strtoupper(trim($value));
        if (false === in_array($value, self::ALL)) {
            throw new InvalidArgumentException(sprintf(
                'Неизвестная валюта "%s". Доступные значения "%s".', $value, implode(',', self::ALL)
            ));
        }

        parent::__construct($value);
    }
}
