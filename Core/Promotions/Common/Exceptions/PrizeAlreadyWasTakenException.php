<?php

namespace Core\Promotions\Common\Exceptions;

use Core\Common\Exceptions\RuntimeException;
use Core\Promotions\Common\Props\ParticipantId;

class PrizeAlreadyWasTakenException extends RuntimeException
{
    private ParticipantId $participantId;

    public function __construct(ParticipantId $participantId)
    {
        parent::__construct("Приз участнику ID $participantId уже был взят.", 400);
        $this->participantId = $participantId;
    }

    public function participantId(): ParticipantId
    {
        return $this->participantId;
    }
}
