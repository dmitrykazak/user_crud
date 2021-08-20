<?php

declare(strict_types=1);

namespace App\Tests\Unit\MessageHandler;

use App\Message\CreateUserMessage;
use App\MessageHandler\CreateUserHandler;
use App\Repository\UserRepositoryInterface;
use App\Tests\Unit\Entity\User\Builder\UserInMemoryBuilder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Mailer\MailerInterface;

final class CreateUserHandlerTest extends TestCase
{
    private UserRepositoryInterface $userRepository;
    private CreateUserHandler $handler;
    private MailerInterface $mailer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userRepository = $this->createStub(UserRepositoryInterface::class);

        $this->mailer = $this->createMock(MailerInterface::class);
        $this->handler = new CreateUserHandler(
            $this->userRepository,
            $this->mailer
        );
    }

    public function testCreateUser(): void
    {
        $user = (new UserInMemoryBuilder())->build();

        /** @var \App\Entity\User $getUser */
        $getUser = $this->userRepository->method('getById')->willReturn($user);
        self::assertSame($user->getId(), $getUser->getId());

        $createNewUser = new CreateUserMessage($getUser->getId(), 'testpassword');

        $this->handler->__invoke($createNewUser);
        $this->mailer->expects(self::once())->method('send');
    }
}
