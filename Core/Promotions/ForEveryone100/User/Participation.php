<?php

namespace Core\Promotions\ForEveryone100\User;

use Core\Common\Props\Amount;
use Core\Common\Props\UserId;
use Core\Common\Event\Events;
use Core\Promotions\Common\Events\PrizeWasTaken;
use Core\Promotions\Common\Exceptions\NotActiveValidityPeriodException;
use Core\Promotions\Common\Exceptions\PrizeAlreadyWasTakenException;
use Core\Promotions\Common\Exceptions\UnavailablePrizeStatusException;
use Core\Promotions\Common\Props\ParticipantId;
use Core\Promotions\Common\Props\PrizeSimpleStatus;
use Core\Promotions\Common\Props\ValidityPeriod;
use Core\Promotions\ForEveryone100\Props\PromotionId;

class Participation
{
    use Events;

    private ParticipantId $id;
    private UserId $userId;
    private PromotionId $promotionId;
    private ValidityPeriod $validityPeriod;
    private Amount $prizeAmount;
    private PrizeSimpleStatus $prizeStatus;

    public function __construct()
    {
        throw new \RuntimeException('Создание нового экземпляра не поддерживается.');
    }

    public function id(): ParticipantId
    {
        return $this->id;
    }

    public function prizeAmount(): Amount
    {
        return $this->prizeAmount;
    }

    public function prizeStatus(): PrizeSimpleStatus
    {
        return $this->prizeStatus;
    }

    /**
     * @throws NotActiveValidityPeriodException
     * @throws PrizeAlreadyWasTakenException
     * @throws UnavailablePrizeStatusException
     */
    public function takePrize(): void
    {
        if (!$this->validityPeriod->isActive()) {
            throw new NotActiveValidityPeriodException($this->id, $this->validityPeriod);
        }

        if ($this->prizeStatus->isWasTaken()) {
            throw new PrizeAlreadyWasTakenException($this->id);
        }

        $validStatus = new PrizeSimpleStatus(PrizeSimpleStatus::CAN_BE_TAKEN);
        if (!$this->prizeStatus->equals($validStatus)) {
            throw new UnavailablePrizeStatusException($this->id, $this->prizeStatus, $validStatus);
        }

        $this->prizeStatus = new PrizeSimpleStatus(PrizeSimpleStatus::WAS_TAKEN);

        $this->addEvent(new PrizeWasTaken(
            $this->id,
            $this->userId,
            $this->promotionId,
            $this->prizeAmount
        ));
    }
}
