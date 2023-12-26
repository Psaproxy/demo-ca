<?php

declare(strict_types=1);

namespace Core\Common\Props;

use Core\Common\Exceptions\InvalidArgumentException;

class Amount
{
    protected const EPSILON = 0.0001;

    protected float $value;

    public function __construct(float $value = null)
    {
        if (null === $value) {
            $this->value = 0.00;
            return;
        }

        if (!is_numeric($value)) {
            throw new InvalidArgumentException('Сумма должно быть числом.');
        }

        $this->value = (float)$value;
    }

    public function value(): float
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }

    public function equals(Amount $comparableValue): bool
    {
        return abs($this->value() - $comparableValue->value()) < static::EPSILON;
    }

    public function isEmpty(): bool
    {
        return $this->equals(new Amount());
    }

    public function isGreaterThan(Amount $amount): bool
    {
        return $this->value() - $amount->value() > static::EPSILON;
    }

    public function isGreaterThanOrEquals(Amount $amount): bool
    {
        return $this->isGreaterThan($amount) || $this->equals($amount);
    }

    public function isLessThan(Amount $amount): bool
    {
        return $amount->value() - $this->value() > static::EPSILON;
    }

    public function isLessThanOrEquals(Amount $amount): bool
    {
        return $this->isLessThan($amount) || $this->equals($amount);
    }

    public function add(Amount $amount): self
    {
        return new static($this->value() + $amount->value());
    }

    public function subtract(Amount $amount): self
    {
        return new static($this->value() - $amount->value());
    }

    public function multiplyByTimes(int $size): self
    {
        return new static($this->value() * $size);
    }
}
