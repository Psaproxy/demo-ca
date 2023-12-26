<?php

namespace Core\Promotions\Common\Exceptions;

use Core\Common\Exceptions\RuntimeException;
use Core\Promotions\Common\Props\PromotionId;
use Core\Promotions\Common\Props\PromotionPeriod;

class PromotionPeriodNotActiveException extends RuntimeException
{
    private PromotionId $promotionId;
    private PromotionPeriod $period;

    public function __construct(PromotionId $promotionId, PromotionPeriod $period)
    {
        parent::__construct(sprintf(
            'Период действия акции ID "%s" неактивен. Дата начала "%s". Дата завершения "%s".',
            $promotionId,
            $period->startsIn()->format('Y-m-d H:i:s'),
            $period->endsIn()->format('Y-m-d H:i:s'),
        ), 400);
        $this->promotionId = $promotionId;
        $this->period = $period;
    }

    public function promotionId(): PromotionId
    {
        return $this->promotionId;
    }

    public function period(): PromotionPeriod
    {
        return $this->period;
    }
}
