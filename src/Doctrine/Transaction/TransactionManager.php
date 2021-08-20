<?php

declare(strict_types=1);

namespace App\Doctrine\Transaction;

use Doctrine\ORM\EntityManagerInterface;

class TransactionManager implements TransactionManagerInterface
{
    protected EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function begin(): void
    {
        $this->em->beginTransaction();
    }

    public function commit(): void
    {
        $this->em->commit();
    }

    public function rollback(): void
    {
        $this->em->rollback();
    }

    /**
     * @return mixed
     */
    public function run(\Closure $fn)
    {
        return $this->em->transactional($fn);
    }
}
