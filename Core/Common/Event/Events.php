<?php

declare(strict_types=1);

namespace Core\Common\Event;

trait Events
{
    /**
     * @var Event[]
     */
    private array $events = [];

    protected function addEvent(Event $event): void
    {
        $this->events[] = $event;
    }

    protected function pushEvents(Event ...$events): void
    {
        $this->events = array_merge($this->events, $events);
    }

    /**
     * @return Event[]
     */
    public function releaseEvents(): array
    {
        $events = $this->events;
        $this->events = [];

        return $events;
    }
}
