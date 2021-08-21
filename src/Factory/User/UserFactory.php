<?php

declare(strict_types=1);

namespace App\Factory\User;

use App\Entity\User;
use App\Message\CreateUserMessage;
use App\Repository\UserRepositoryInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFactory
{
    private UserPasswordHasherInterface $userPasswordHasher;
    private UserRepositoryInterface $userRepository;
    private MessageBusInterface $messageBus;

    public function __construct(
        UserRepositoryInterface $userRepository,
        UserPasswordHasherInterface $userPasswordHasher,
        MessageBusInterface $messageBus
    ) {
        $this->userPasswordHasher = $userPasswordHasher;
        $this->userRepository = $userRepository;
        $this->messageBus = $messageBus;
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

        $this->messageBus->dispatch(new CreateUserMessage($user->getId(), $password));
    }
}
