<?php

namespace Core\Promotions\ForEveryone100\User\DTO;

class PromotionDTO
{
    public string $prizeAmount;
    public int $endsIn;

    public function __construct(string $prizeAmount, int $endsIn)
    {
        $this->prizeAmount = $prizeAmount;
        $this->endsIn = $endsIn;
    }


}
