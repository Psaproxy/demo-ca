<?php

namespace Core\Promotions\ForEveryone100\User\DTO;

class ParticipantDTO
{
    public string $startsIn;
    public string $endsIn;
    public string $status;
    public string $progressAmountCurrent;
    public string $progressAmountMax;

    public function __construct(string $startsIn, string $endsIn, string $status, string $progressAmountCurrent, string $progressAmountMax)
    {
        $this->startsIn = $startsIn;
        $this->endsIn = $endsIn;
        $this->status = $status;
        $this->progressAmountCurrent = $progressAmountCurrent;
        $this->progressAmountMax = $progressAmountMax;
    }
}
