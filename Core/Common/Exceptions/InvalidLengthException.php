<?php

declare(strict_types=1);

namespace Core\Common\Exceptions;

use Throwable;

class InvalidLengthException extends InvalidArgumentException
{
    private int $validMinLength;
    private int $validMaxLength;

    public function __construct(
        int $validMinLength,
        int $validMaxLength,
        string $message,
        $code = 0,
        Throwable $previous = null
    )
    {
        $this->validMinLength = $validMinLength;
        $this->validMaxLength = $validMaxLength;

        parent::__construct($message, $code, $previous);
    }

    public function validMinLength(): int
    {
        return $this->validMinLength;
    }

    public function validMaxLength(): int
    {
        return $this->validMaxLength;
    }
}
