<?php

declare(strict_types=1);

namespace Core\Common\Props;

class CurrencyDefault extends Currency
{
    public function __construct()
    {
        parent::__construct(self::USD);
    }
}
