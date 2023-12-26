<?php

namespace Core\Promotions\Common\Props;

class TriggerName extends \Core\Common\Props\TriggerName
{
    public function __construct(PromotionId $promotionId)
    {
        parent::__construct("promotion_$promotionId");
    }
}
