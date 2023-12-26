<?php

declare(strict_types=1);

namespace Core\Common\Props;

use Core\Common\Exceptions\InvalidArgumentException;

class Text
{
    protected string $value;

    public function __construct(string $value = '')
    {
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * @param Text|string|numeric $comparableValue
     */
    public function equals($comparableValue): bool
    {
        $typeisInvalid = true;
        if (is_numeric($comparableValue)) {
            $comparableValue = (string)$comparableValue;
        } elseif (!is_string($comparableValue)) {
            $typeisInvalid = false;
        }

        if ($typeisInvalid) {
            $comparableValueType = gettype($comparableValue);
            throw new InvalidArgumentException("Недоступный тип \"$comparableValueType\" значения. Доступные типы \"Text, строка, число\".");
        }

        return $this->value() === $comparableValue->value();
    }

    public function isEmpty(): bool
    {
        return empty($this->value());
    }
}
