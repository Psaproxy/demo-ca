<?php

declare(strict_types=1);

namespace Core\Common\Event;

interface IEvents
{
    /**
     * @return Event[]
     */
    public function releaseEvents(): array;
}
