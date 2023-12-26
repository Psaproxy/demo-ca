<?php

namespace Core\Promotions\Common\Props;

use Core\Common\Props\Text;

abstract class Status extends Text
{
    public function __construct(string $value)
    {
        $valueRaw = $value;
        $value = strtolower(trim($value));
        if (!in_array($value, $this->allValues())) {
            throw new \InvalidArgumentException(sprintf(
                'Недоступный статус "%s". Доступные статусы: "%s".',
                $valueRaw, implode(',', $this->allValues())
            ));
        }

        parent::__construct($value);
    }

    abstract protected function allValues(): array;
}
