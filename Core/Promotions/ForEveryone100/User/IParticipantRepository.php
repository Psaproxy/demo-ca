<?php

namespace Core\Promotions\ForEveryone100\User;

use Core\Common\Props\UserId;
use Core\Common\Exceptions\Entity\NotFoundEntityException;

interface IParticipantRepository
{
    /**
     * @throws NotFoundEntityException
     */
    public function getParticipant(UserId $userId): Participation;

    public function markPrizeAsTaken(Participation $participant): void;
}
