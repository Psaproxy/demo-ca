<?php

namespace Core\Promotions\Common\Props;

use Core\Common\Props\Text;

class PromotionId extends Text
{
    public function __construct(string $value)
    {
        $value = strtolower(trim($value));
        if ('' === $value) {
            throw new \InvalidArgumentException('Не указан ID акции. ID должен быть не пустой строкой из: a-z, 0-9.');
        }

        parent::__construct($value);
    }
}
