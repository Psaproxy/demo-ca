<?php

declare(strict_types=1);

namespace Core\Common\Props;

use Core\Common\Exceptions\InvalidArgumentException;

class UserId extends Number
{
    public function __construct(int $value)
    {
        if (1 > $value) {
            throw new InvalidArgumentException(sprintf('ID пользователя "%s" должен быть больше 0.', $value));
        }

        parent::__construct($value);
    }
}
