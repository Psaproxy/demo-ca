<?php

namespace Core\Promotions\Common\Props;

abstract class Settings
{
    private ?array $values;

    public function __construct(?array $values = null)
    {
        $this->values = $values;
    }

    public function values(): ?array
    {
        return $this->values;
    }
}
