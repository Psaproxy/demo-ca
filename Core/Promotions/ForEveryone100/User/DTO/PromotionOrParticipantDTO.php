<?php

namespace Core\Promotions\ForEveryone100\User\DTO;

class PromotionOrParticipantDTO
{
    public ?PromotionDTO $activePromotion;
    public ?ParticipantDTO $participant;

    public function __construct(?PromotionDTO $promotion, ?ParticipantDTO $participant)
    {
        $this->activePromotion = $promotion;
        $this->participant = $participant;
    }


}
