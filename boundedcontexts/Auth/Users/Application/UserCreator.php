<?php

declare(strict_types = 1);

namespace Ceiboo\Auth\Users\Application;

use Ceiboo\Auth\Users\Application\CreateUserRequest;
use Ceiboo\Auth\Users\Domain\Repositories\UserRepository;
use Ceiboo\Auth\Users\Domain\Entities\User;
use Ceiboo\Auth\Users\Domain\ValueObjects\UserId;
use Ceiboo\Auth\Users\Domain\ValueObjects\UserName;
use Ceiboo\Auth\Users\Domain\ValueObjects\UserEmail;
use Ceiboo\Auth\Users\Domain\ValueObjects\UserToken;
use Ceiboo\Auth\Users\Domain\ValueObjects\UserPassword;
use Ceiboo\Auth\Users\Domain\ValueObjects\UserStatus;

final class UserCreator {

    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(CreateUserRequest $request)
    {
        $id         = new UserId($request->id());
        $name       = new UserName($request->name());
        $email      = new UserEmail($request->email());
        $token      = new UserToken($request->token());
        $password   = new UserPassword($request->password());
        $status     = new UserStatus($request->status());

        $user = User::create($id, $name, $email, $token, $password, $status);

        $this->repository->save($user);
    }
}
