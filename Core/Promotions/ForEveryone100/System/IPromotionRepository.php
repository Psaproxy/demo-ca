<?php

namespace Core\Promotions\ForEveryone100\System;

use Core\Common\Props\UserId;

interface IPromotionRepository
{
    public function findActiveForUser(UserId $userId): ?Promotion;
}
