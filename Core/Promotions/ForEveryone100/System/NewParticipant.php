<?php /** @noinspection PhpPropertyOnlyWrittenInspection */

namespace Core\Promotions\ForEveryone100\System;

use Core\Common\Props\Amount;
use Core\Common\Props\UserId;
use Core\Promotions\Common\Props\ParticipantId;
use Core\Promotions\Common\Props\PrizeSimpleStatus;
use Core\Promotions\Common\Props\ValidityPeriod;
use Core\Promotions\ForEveryone100\Props\PromotionId;

class NewParticipant
{
    private ParticipantId $id;
    private UserId $userId;
    private PromotionId $promotionId;
    private ValidityPeriod $validityPeriod;
    private PrizeSimpleStatus $prizeStatus;
    private Amount $prizeAmount;

    public function __construct(
        UserId         $userId,
        PromotionId    $promotionId,
        ValidityPeriod $validityPeriod,
        Amount         $prizeAmount
    )
    {
        $this->userId = $userId;
        $this->promotionId = $promotionId;
        $this->validityPeriod = $validityPeriod;
        $this->prizeStatus = new PrizeSimpleStatus(PrizeSimpleStatus::NOT_TAKEN);
        $this->prizeAmount = $prizeAmount;
    }

    public function id(): ParticipantId
    {
        return $this->id;
    }

    public function userId(): UserId
    {
        return $this->userId;
    }

    public function promotionId(): PromotionId
    {
        return $this->promotionId;
    }

    public function validityPeriod(): ValidityPeriod
    {
        return $this->validityPeriod;
    }

    public function prizeAmount(): Amount
    {
        return $this->prizeAmount;
    }

    public function prizeStatus(): PrizeSimpleStatus
    {
        return $this->prizeStatus;
    }
}
