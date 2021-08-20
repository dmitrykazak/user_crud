<?php

declare(strict_types=1);

namespace App\Doctrine\Transaction;

interface TransactionManagerInterface
{
    public function begin(): void;

    public function commit(): void;

    public function rollback(): void;

    /**
     * @return mixed
     */
    public function run(\Closure $fn);
}
