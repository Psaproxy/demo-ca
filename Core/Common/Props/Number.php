<?php

declare(strict_types=1);

namespace Core\Common\Props;

use Core\Common\Exceptions\InvalidArgumentException;

class Number
{
    protected int $value;

    public function __construct(int $value = 0)
    {
        $this->value = $value;
    }

    public function value(): int
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }

    /**
     * @param Number|int $comparableValue
     * @return bool
     */
    public function equals($comparableValue): bool
    {
        $typeisInvalid = false;
        if (is_numeric($comparableValue)) {
            $comparableValue *= 1;
            if (is_int($comparableValue)) {
                $comparableValue = new self($comparableValue);
            } else {
                $typeisInvalid = true;
            }
        } else {
            $typeisInvalid = true;
        }

        if ($typeisInvalid) {
            $comparableValueType = gettype($comparableValue);
            throw new InvalidArgumentException("Недоступный тип \"$comparableValueType\" значения. Доступные типы \"int, int в строке\".");
        }

        return $this->value() === $comparableValue->value();
    }

    public function isEmpty(): bool
    {
        return empty($this->value());
    }
}
