<?php

namespace Core\Promotions\ForEveryone100\System\Listeners;

use Core\Common\Infrastructure\IDBTransaction;
use Core\Promotions\Common\Props\PrizeSimpleStatus;
use Core\Promotions\ForEveryone100\System\IParticipantRepository;
use Core\Promotions\ForEveryone100\System\Participant;

class UpdateParticipantProgress
{
    private IParticipantRepository $participantRepository;
    private IDBTransaction $transaction;

    public function __construct(
        IParticipantRepository $participantRepository,
        IDBTransaction         $transaction
    )
    {
        $this->participantRepository = $participantRepository;
        $this->transaction = $transaction;
    }

    public function __invoke(BonusWasSentToUser $event): void
    {
        $userId = $event->userId();
        $addProgressAmount = $event->price()->amount();

        $filterStatus = new PrizeSimpleStatus(Participant::VALID_PRIZE_STATUS);
        $participant = $this->participantRepository->findActiveWithStatus($userId, $filterStatus);
        if (!$participant) return;

        $participant->incProgress($addProgressAmount);

        $this->transaction->execute(function () use ($participant) {
            $this->participantRepository->updateProgress($participant);
        });
    }
}
