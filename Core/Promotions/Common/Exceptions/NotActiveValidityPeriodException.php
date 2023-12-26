<?php

namespace Core\Promotions\Common\Exceptions;

use Core\Common\Exceptions\RuntimeException;
use Core\Promotions\Common\Props\ParticipantId;
use Core\Promotions\Common\Props\ValidityPeriod;

class NotActiveValidityPeriodException extends RuntimeException
{
    private ParticipantId $participantId;
    private ValidityPeriod $validityPeriod;

    public function __construct(ParticipantId $participantId, ValidityPeriod $validityPeriod)
    {
        parent::__construct(sprintf(
            'Период действия участника ID %s неактивен. Дата начала "%s". Дата завершения "%s".',
            $participantId,
            $validityPeriod->startsIn()->format('Y-m-d H:i:s'),
            $validityPeriod->endsIn()->format('Y-m-d H:i:s'),
        ), 400);
        $this->participantId = $participantId;
        $this->validityPeriod = $validityPeriod;
    }

    public function participantId(): ParticipantId
    {
        return $this->participantId;
    }

    public function validityPeriod(): ValidityPeriod
    {
        return $this->validityPeriod;
    }
}
