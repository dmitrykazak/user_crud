<?php

declare(strict_types=1);

namespace App\MessageHandler;

use App\Message\CreateUserMessage;
use App\Repository\UserRepositoryInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Mime\Email;

final class CreateUserHandler implements MessageHandlerInterface
{
    private UserRepositoryInterface $userRepository;
    private MailerInterface $mailer;

    public function __construct(UserRepositoryInterface $userRepository, MailerInterface $mailer)
    {
        $this->userRepository = $userRepository;
        $this->mailer = $mailer;
    }

    public function __invoke(CreateUserMessage $createUserMessage): void
    {
        $user = $this->userRepository->getById($createUserMessage->getId());

        $email = (new Email())
            ->from('')
            ->to($user->getEmail())
            ->subject('Create new Customer')
            ->text('Sending emails is fun again!')
            ->html(\sprintf('<p>Username: %s<br>Password: %s</p>', $user->getEmail(), $createUserMessage->getPassword()));

        $this->mailer->send($email);
    }
}
