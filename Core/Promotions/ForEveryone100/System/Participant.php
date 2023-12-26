<?php /** @noinspection PhpPropertyOnlyWrittenInspection */

namespace Core\Promotions\ForEveryone100\System;

use Core\Common\Props\Amount;
use Core\Promotions\Common\Exceptions\NotActiveValidityPeriodException;
use Core\Promotions\Common\Exceptions\UnavailablePrizeStatusException;
use Core\Promotions\Common\Props\ParticipantId;
use Core\Promotions\Common\Props\PrizeSimpleStatus;
use Core\Promotions\Common\Props\ProgressAmountCurrent;
use Core\Promotions\Common\Props\ProgressAmountMax;
use Core\Promotions\Common\Props\ValidityPeriod;

class Participant
{
    public const VALID_PRIZE_STATUS = PrizeSimpleStatus::NOT_TAKEN;

    private ParticipantId $id;
    private ValidityPeriod $validityPeriod;
    private PrizeSimpleStatus $prizeStatus;
    private ?bool $isPrizeStatusWasUpdated = null;
    private ?Amount $addedProgressAmount = null;
    private ProgressAmountCurrent $progressAmountCurrent;
    private ProgressAmountMax $progressAmountMax;

    public function __construct()
    {
        throw new \RuntimeException('Создание нового экземпляра не поддерживается.');
    }

    public function id(): ParticipantId
    {
        return $this->id;
    }

    public function prizeStatus(): PrizeSimpleStatus
    {
        return $this->prizeStatus;
    }

    public function isPrizeStatusWasUpdated(): bool
    {
        return true === $this->isPrizeStatusWasUpdated;
    }

    public function addedProgressAmount(): ?Amount
    {
        return $this->addedProgressAmount;
    }

    public function incProgress(Amount $addAmount): void
    {
        if (!$this->validityPeriod->isActive()) {
            throw new NotActiveValidityPeriodException($this->id, $this->validityPeriod);
        }

        $validStatus = new PrizeSimpleStatus(self::VALID_PRIZE_STATUS);
        if (!$this->prizeStatus->equals($validStatus)) {
            throw new UnavailablePrizeStatusException($this->id, $this->prizeStatus, $validStatus);
        }

        $this->addedProgressAmount = ($this->addedProgressAmount ?: new Amount())->add($addAmount);
        $this->progressAmountCurrent = $this->progressAmountCurrent->add($this->addedProgressAmount);

        if ($this->progressAmountCurrent->isGreaterThanOrEquals($this->progressAmountMax)) {
            $this->prizeStatus = new PrizeSimpleStatus(PrizeSimpleStatus::CAN_BE_TAKEN);
            $this->isPrizeStatusWasUpdated = true;
        }
    }
}
