<?php

namespace Core\Promotions\Common\Props;

class PrizeSimpleStatus extends PrizeStatus
{
    public const NOT_TAKEN = 'not_taken';
    public const CAN_BE_TAKEN = 'can_be_taken';
    public const WAS_TAKEN = 'was_taken';

    protected function allValues(): array
    {
        return [
            self::NOT_TAKEN,
            self::CAN_BE_TAKEN,
            self::WAS_TAKEN,
        ];
    }

    public function isNotTaken(): bool
    {
        return $this->value === self::NOT_TAKEN;
    }

    public function isCanBeTaken(): bool
    {
        return $this->value === self::CAN_BE_TAKEN;
    }

    public function isWasTaken(): bool
    {
        return $this->value === self::WAS_TAKEN;
    }
}
