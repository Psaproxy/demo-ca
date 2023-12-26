<?php

declare(strict_types=1);

namespace Core\Common\Infrastructure;

interface IDBTransaction
{
    public function beginTransaction(): void;

    public function commit(): void;

    public function rollBack(): void;

    /**
     * @param callable $processAction
     * @return mixed
     * @throws \Throwable
     */
    public function transaction(callable $processAction);

    public function execute(callable $processAction);
}
