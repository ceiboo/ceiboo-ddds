<?php

declare(strict_types = 1);

namespace Ceiboo\Auth\Users\Application;

final class CreateUserRequest
{
    private $id;
    private $name;
    private $email;
    private $token;
    private $password;
    private $status;

    public function __construct(string $id, string $name, string $email, string $token, string $password, ?string $status)
    {
        $this->id       = $id;
        $this->name     = $name;
        $this->email    = $email;
        $this->token    = $token;
        $this->password = $password;
        $this->status   = $status;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function token(): string
    {
        return $this->token;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function status(): ?string
    {
        return $this->status;
    }
}
