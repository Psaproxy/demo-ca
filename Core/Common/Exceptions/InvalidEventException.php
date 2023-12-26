<?php

namespace Core\Common\Exceptions;

use Core\Common\Event\Event;

class InvalidEventException extends InvalidArgumentException
{
    private Event $invalidEvent;
    /**
     * @var string[]
     */
    private array $validEvents;

    public function __construct(Event $invalidEvent, string ...$validEventsClasses)
    {
        parent::__construct(
            sprintf(
                '"Недоступное событие "%s". Доступные события: "%s".',
                get_class($invalidEvent),
                implode(',', $validEventsClasses)
            ),
            400
        );
        $this->invalidEvent = $invalidEvent;
        $this->validEvents = $validEventsClasses;
    }

    public function invalidEvent(): Event
    {
        return $this->invalidEvent;
    }

    /**
     * @return string[]
     */
    public function validEvents(): array
    {
        return $this->validEvents;
    }
}
