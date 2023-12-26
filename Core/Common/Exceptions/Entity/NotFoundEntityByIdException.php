<?php

declare(strict_types=1);

namespace Core\Common\Exceptions\Entity;

use Throwable;

class NotFoundEntityByIdException extends NotFoundEntityException
{
    public function __construct(string $entityId, $code = 0, Throwable $previous = null)
    {
        parent::__construct(
            sprintf('Не удалось найти сущность с ID "%s"', $entityId),
            $code,
            $previous
        );
    }
}
