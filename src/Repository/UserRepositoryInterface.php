<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\User;
use App\Exception\UserNotFoundException;

interface UserRepositoryInterface
{
    public function save(User $user): void;

    /**
     * @throws UserNotFoundException
     */
    public function getById(int $id): User;
}
