<?php

namespace Core\Promotions\Common\Exceptions;

use Core\Common\Exceptions\RuntimeException;
use Core\Promotions\Common\Props\PromotionId;

class PromotionNotActiveException extends RuntimeException
{
    private PromotionId $promotionId;

    public function __construct(PromotionId $promotionId)
    {
        parent::__construct("Акция ID \"$promotionId\" неактивна.", 400);
        $this->promotionId = $promotionId;
    }

    public function promotionId(): PromotionId
    {
        return $this->promotionId;
    }
}
