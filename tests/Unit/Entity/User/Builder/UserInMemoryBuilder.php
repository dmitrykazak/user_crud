<?php

declare(strict_types=1);

namespace App\Tests\Unit\Entity\User\Builder;

final class UserInMemoryBuilder
{
    private int $id;
    private string $email;
    private string $username;
    private string $lastname;
    private string $firstname;
    private string $password;

    public function __construct()
    {
        $this->id = 1;
        $this->email = 'test@test.com';
        $this->username = 'unit_test';
        $this->firstname = 'unit_firstname';
        $this->lastname = 'unit_lastname';
        $this->password = 'admin';
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function withId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function withEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function withUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function withFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function withLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function withPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
}
