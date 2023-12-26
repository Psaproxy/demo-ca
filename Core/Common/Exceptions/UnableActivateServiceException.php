<?php

namespace Core\Common\Exceptions;

use Throwable;

class UnableActivateServiceException extends RuntimeException
{
    public function __construct(Throwable $errorException)
    {
        parent::__construct($errorException->getMessage(), $errorException->getCode(), $errorException->getPrevious());
    }
}
