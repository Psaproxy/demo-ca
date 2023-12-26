<?php

namespace Core\Promotions\ForEveryone100\System;

use Core\Common\Props\UserId;
use Core\Promotions\Common\Props\PrizeStatus;

interface IParticipantRepository
{
    public function hasByUserId(UserId $userId): bool;

    public function add(NewParticipant ...$participants): void;

    public function findActiveWithStatus(UserId $userId, PrizeStatus $filterStatus): ?Participant;

    public function updateProgress(Participant $participant): void;
}
