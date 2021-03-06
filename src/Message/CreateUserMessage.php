<?php

declare(strict_types=1);

namespace App\Message;

final class CreateUserMessage
{
    private int $id;
    private string $password;

    public function __construct(int $id, string $password)
    {
        $this->id = $id;
        $this->password = $password;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
