<?php

namespace Core\Promotions\ForEveryone100\User\Actions;

use Core\Common\Props\UserId;
use Core\Promotions\ForEveryone100\User\DTO\PromotionOrParticipantDTO;
use Core\Promotions\ForEveryone100\User\IDataProvider;

class FindPromotionOrParticipant
{
    private IDataProvider $dataProvider;

    public function __construct(
        IDataProvider $dataProvider
    )
    {
        $this->dataProvider = $dataProvider;
    }

    public function find(int $userId): ?PromotionOrParticipantDTO
    {
        $userId = new UserId($userId);
        return $this->dataProvider->findActivePromotionOrParticipant($userId);
    }
}
