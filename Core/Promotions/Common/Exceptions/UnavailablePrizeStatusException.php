<?php

namespace Core\Promotions\Common\Exceptions;

use Core\Common\Exceptions\RuntimeException;
use Core\Promotions\Common\Props\ParticipantId;
use Core\Promotions\Common\Props\PrizeStatus;

class UnavailablePrizeStatusException extends RuntimeException
{
    private ParticipantId $participantId;
    private PrizeStatus $currentPrizeStatus;
    private PrizeStatus $validPrizeStatus;

    public function __construct(ParticipantId $participantId, PrizeStatus $currentPrizeStatus, PrizeStatus $validPrizeStatus)
    {
        parent::__construct(sprintf(
            'Недоступный статус приза "%s" для участника ID %s. Доступный статус приза "%s".',
            $currentPrizeStatus, $participantId, $validPrizeStatus
        ), 400);
        $this->participantId = $participantId;
        $this->currentPrizeStatus = $currentPrizeStatus;
        $this->validPrizeStatus = $validPrizeStatus;
    }

    public function participantId(): ParticipantId
    {
        return $this->participantId;
    }

    public function currentPrizeStatus(): PrizeStatus
    {
        return $this->currentPrizeStatus;
    }

    public function validPrizeStatus(): PrizeStatus
    {
        return $this->validPrizeStatus;
    }
}
