<?php

namespace Core\Promotions\ForEveryone100\User\Actions;

use Core\Common\Event\IEventsPublisher;
use Core\Common\Exceptions\Entity\NotFoundEntityException;
use Core\Common\Infrastructure\IDBTransaction;
use Core\Common\Props\UserId;
use Core\Promotions\Common\Exceptions\NotActiveValidityPeriodException;
use Core\Promotions\Common\Exceptions\PrizeAlreadyWasTakenException;
use Core\Promotions\Common\Exceptions\UnavailablePrizeStatusException;
use Core\Promotions\ForEveryone100\User\IParticipantRepository;

class TakePrize
{
    private IParticipantRepository $participantRepository;
    private IDBTransaction $transaction;
    private IEventsPublisher $eventsPublisher;

    public function __construct(
        IParticipantRepository $participantRepository,
        IDBTransaction         $transaction,
        IEventsPublisher       $eventsPublisher
    )
    {
        $this->participantRepository = $participantRepository;
        $this->transaction = $transaction;
        $this->eventsPublisher = $eventsPublisher;
    }

    /**
     * @throws NotFoundEntityException
     * @throws NotActiveValidityPeriodException
     * @throws PrizeAlreadyWasTakenException
     * @throws UnavailablePrizeStatusException
     * @throws \Throwable
     */
    public function take(int $userId): string
    {
        $userId = new UserId($userId);
        $participant = $this->participantRepository->getParticipant($userId);

        $participant->takePrize();

        $this->transaction->execute(function () use ($participant) {
            $this->participantRepository->markPrizeAsTaken($participant);
            $this->eventsPublisher->publish(...$participant->releaseEvents());
        });

        return $participant->prizeAmount();
    }
}
