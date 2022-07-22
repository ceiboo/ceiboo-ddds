<?php

declare(strict_types = 1);

namespace Ceiboo\Auth\Users\Domain\Entities;

use Ceiboo\Auth\Users\Domain\ValueObjects\UserId;
use Ceiboo\Auth\Users\Domain\ValueObjects\UserName;
use Ceiboo\Auth\Users\Domain\ValueObjects\UserEmail;
use Ceiboo\Auth\Users\Domain\ValueObjects\UserToken;
use Ceiboo\Auth\Users\Domain\ValueObjects\UserPassword;
use Ceiboo\Auth\Users\Domain\ValueObjects\UserStatus;
use Ceiboo\Shared\Domain\Aggregate\AggregateRoot;

final class User extends AggregateRoot
{
    private $id;
    private $name;
    private $email;
    private $token;
    private $status;

    public function __construct(UserId $id,
                                UserName $name,
                                UserEmail $email,
                                UserToken $token,
                                UserPassword $password,
                                UserStatus $status)
    {
        $this->id       = $id;
        $this->name     = $name;
        $this->email    = $email;
        $this->token    = $token;
        $this->password = $password;
        $this->status   = $status;
    }

    public static function create(UserId $id,
                                UserName $name,
                                UserEmail $email,
                                UserToken $token,
                                UserPassword $password,
                                UserStatus $status): self
    {
        $user = new self($id, $name, $email, $token, $password, $status);

        //$user->record(new UserCreatedDomainEvent($id->value(), $name->value(), $address->value(), $country->value(), $status->value()));

        return $user;
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function name(): UserName
    {
        return $this->name;
    }

    public function email(): UserEmail
    {
        return $this->email;
    }

    public function token(): UserToken
    {
        return $this->token;
    }

    public function password(): UserPassword
    {
        return $this->password;
    }

    public function status(): UserStatus
    {
        return $this->status;
    }
}
