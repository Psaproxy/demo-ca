<?php

namespace Core\Promotions\ForEveryone100\System\Listeners;

use Core\Common\Event\Event;
use Core\Common\Exceptions\InvalidEventException;
use Core\Common\Infrastructure\IDBTransaction;
use Core\Promotions\Common\Exceptions\PromotionNotActiveException;
use Core\Promotions\Common\Exceptions\PromotionPeriodNotActiveException;
use Core\Promotions\ForEveryone100\System\IParticipantRepository;
use Core\Promotions\ForEveryone100\System\IPromotionRepository;

class AddParticipant
{
    private IPromotionRepository $promotionRepository;
    private IParticipantRepository $participantRepository;
    private IDBTransaction $transaction;

    public function __construct(
        IPromotionRepository   $promotionRepository,
        IParticipantRepository $participantRepository,
        IDBTransaction         $transaction
    )
    {
        $this->promotionRepository = $promotionRepository;
        $this->participantRepository = $participantRepository;
        $this->transaction = $transaction;
    }

    /**
     * @param ServiceWasActivated|ServiceWasRaised|ServiceWasRaisedAndProlonged $event
     * @throws PromotionNotActiveException
     * @throws PromotionPeriodNotActiveException
     * @throws \Exception
     */
    public function __invoke(Event $event): void
    {
        if (!($event instanceof ServiceWasActivated)
            && !($event instanceof ServiceWasRaised)
            && !($event instanceof ServiceWasRaisedAndProlonged)
        ) {
            throw new InvalidEventException($event, ...[
                ServiceWasActivated::class,
                ServiceWasRaised::class,
                ServiceWasRaisedAndProlonged::class,
            ]);
        }

        $userId = $event->userId();

        $promotion = $this->promotionRepository->findActiveForUser($userId);
        if (!$promotion) return;

        if ($this->participantRepository->hasByUserId($userId)) return;

        $promotion->addParticipant($userId);

        $this->transaction->execute(function () use ($promotion) {
            $this->participantRepository->add(...$promotion->newParticipants());
        });
    }
}
