<?php

declare(strict_types=1);

namespace App\Tests\Unit\Entity\User;

use App\Entity\User;
use App\Tests\Unit\Entity\User\Builder\UserInMemoryBuilder;

final class UserInMemory extends User
{
    private int $id;

    public function __construct(UserInMemoryBuilder $builder)
    {
        $user = new User();
        $user->setEmail($builder->getEmail());
        $user->setPassword($builder->getPassword());
        $user->setFirstname($builder->getFirstname());
        $user->setLastname($builder->getLastname());
        $user->setUsername($builder->getUsername());

        $this->id = $builder->getId();
    }

    public function getId(): int
    {
        return $this->id;
    }
}