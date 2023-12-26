<?php

declare(strict_types=1);

namespace Core\Common\Exceptions;

use Throwable;

class UnacceptableSymbolsException extends InvalidArgumentException
{
    /**
     * @var string[]
     */
    private array $validSymbols;

    public function __construct(
        array $validSymbols,
        string $message,
        $code = 0,
        Throwable $previous = null
    )
    {
        $this->validSymbols = $validSymbols;

        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string[]
     */
    public function validSymbols(): array
    {
        return $this->validSymbols;
    }
}
