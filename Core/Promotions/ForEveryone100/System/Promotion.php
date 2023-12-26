<?php /** @noinspection PhpPropertyOnlyWrittenInspection */

namespace Core\Promotions\ForEveryone100\System;

use Core\Common\Props\Amount;
use Core\Common\Props\UserId;
use Core\Promotions\Common\Exceptions\PromotionNotActiveException;
use Core\Promotions\Common\Exceptions\PromotionPeriodNotActiveException;
use Core\Promotions\Common\Props\PromotionPeriod;
use Core\Promotions\Common\Props\ValidityPeriod;
use Core\Promotions\ForEveryone100\Props\PromotionId;

class Promotion
{
    private PromotionId $id;
    private bool $isActive;
    private PromotionPeriod $period;
    private Amount $prizeAmount;
    /** @var NewParticipant[] */
    private array $newParticipants = [];

    public function __construct()
    {
        throw new \RuntimeException('Создание нового экземпляра не поддерживается.');
    }

    public function id(): PromotionId
    {
        return $this->id;
    }

    /**
     * @return NewParticipant[]
     */
    public function newParticipants(): array
    {
        return array_values($this->newParticipants);
    }

    /**
     * @throws PromotionNotActiveException
     * @throws PromotionPeriodNotActiveException
     * @throws \Exception
     */
    public function addParticipant(UserId $userId): void
    {
        if (!$this->isActive) {
            throw new PromotionNotActiveException($this->id);
        }

        if (!$this->period->isActive()) {
            throw new PromotionPeriodNotActiveException($this->id, $this->period);
        }

        $this->newParticipants[$userId->value()] = new NewParticipant(
            $userId,
            $this->id,
            new ValidityPeriod(
                new \DateTimeImmutable(),
                (new \DateTimeImmutable())->setTime(23, 23, 59)->add(new \DateInterval("P90D")),
            ),
            $this->prizeAmount,
        );
    }
}
