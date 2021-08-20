<?php

declare(strict_types=1);

namespace App\Factory\User;

use App\Entity\User;
use App\Repository\UserRepositoryInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UserFactory
{
    private UserPasswordHasherInterface $userPasswordHasher;
    private UserRepositoryInterface $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        UserPasswordHasherInterface $userPasswordHasher
    ) {
        $this->userPasswordHasher = $userPasswordHasher;
        $this->userRepository = $userRepository;
    }

    public function create(
        string $username,
        string $email,
        string $firstname,
        string $lastname
    ): void {
        $user = new User();
        $user->setRoles(['ROLE_USER']);
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setFirstname($firstname);
        $user->setLastname($lastname);

        $password = $this->userPasswordHasher->hashPassword($user, \random_bytes(10));
        $user->setPassword($password);

        $this->userRepository->save($user);
    }
}
