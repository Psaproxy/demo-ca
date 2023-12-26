<?php

namespace Core\Promotions\Common\Props;

class ValidityPeriod
{
    private \DateTimeImmutable $startsIn;
    private \DateTimeImmutable $endsIn;

    public function __construct(\DateTimeImmutable $startsIn, \DateTimeImmutable $endsIn)
    {
        $this->startsIn = $startsIn;
        $this->endsIn = $endsIn;
    }

    public function startsIn(): \DateTimeImmutable
    {
        return $this->startsIn;
    }

    public function endsIn(): \DateTimeImmutable
    {
        return $this->endsIn;
    }

    public function isActive(\DateTimeImmutable $currentDatetime = null): bool
    {
        $currentDatetime = !$currentDatetime ? new \DateTimeImmutable() : $currentDatetime;

        return $currentDatetime >= $this->startsIn && $currentDatetime <= $this->endsIn;
    }
}
