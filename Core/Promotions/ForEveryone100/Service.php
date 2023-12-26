<?php

namespace Core\Promotions\ForEveryone100;

class Service
{
    /**
     * @throws \Exception
     */
    public static function getPromotionEndsIn(): \DateTimeImmutable
    {
        return new \DateTimeImmutable(date("Y-m-d 23:59:59", strtotime('last day of')));
    }
}
