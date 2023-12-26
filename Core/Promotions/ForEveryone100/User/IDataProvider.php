<?php

namespace Core\Promotions\ForEveryone100\User;

use Core\Common\Props\UserId;
use Core\Promotions\ForEveryone100\User\DTO\PromotionOrParticipantDTO;

interface IDataProvider
{
    public function findActivePromotionOrParticipant(UserId $userId): ?PromotionOrParticipantDTO;
}
