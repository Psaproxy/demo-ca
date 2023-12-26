<?php

namespace Core\Promotions\Common\Events;

use Core\Common\Props\Amount;
use Core\Common\Props\Price;
use Core\Common\Props\UserId;
use Core\Common\Events\FundWasSentToUser;
use Core\Promotions\Common\Props\ParticipantId;
use Core\Promotions\Common\Props\TriggerName;
use Core\Promotions\ForEveryone100\Props\PromotionId;

class PrizeWasTaken extends FundWasSentToUser
{
    private ParticipantId $participantId;
    private UserId $userId;
    private PromotionId $promotionId;
    private Amount $prizeAmount;

    public function __construct(
        ParticipantId $participantId,
        UserId        $userId,
        PromotionId   $promotionId,
        Amount        $prizeAmount
    )
    {
        $this->participantId = $participantId;
        $this->userId = $userId;
        $this->promotionId = $promotionId;
        $this->prizeAmount = $prizeAmount;
        parent::__construct(
            null, $userId, new Price($this->prizeAmount), new TriggerName($this->promotionId)
        );
    }

    public function participantId(): ParticipantId
    {
        return $this->participantId;
    }

    public function userId(): UserId
    {
        return $this->userId;
    }

    public function promotionId(): PromotionId
    {
        return $this->promotionId;
    }

    public function prizeAmount(): Amount
    {
        return $this->prizeAmount;
    }
}
