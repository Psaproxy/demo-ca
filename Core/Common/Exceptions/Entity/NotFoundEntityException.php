<?php

declare(strict_types=1);

namespace Core\Common\Exceptions\Entity;

use Core\Common\Exceptions\RuntimeException;
use Throwable;

class NotFoundEntityException extends RuntimeException
{
    public function __construct(string $message, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
