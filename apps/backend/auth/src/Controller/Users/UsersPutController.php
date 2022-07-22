<?php

declare(strict_types = 1);

namespace Ceiboo\Apps\Backend\Auth\Controller\Users;

use Ceiboo\Auth\Users\Application\UserCreator;
use Ceiboo\Auth\Users\Application\CreateUserRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class UsersPutController
{
    private $creator;

    public function __construct(UserCreator $creator)
    {
        $this->creator = $creator;
    }

    public function __invoke(string $id, Request $request): Response
    {
        $company_id = $request->request->get('company_id');
        $name = $request->request->get('name');
        $email = $request->request->get('email');
        $token = $request->request->get('token');
        $password = $request->request->get('password');
        $status = $request->request->get('status');

        $this->creator->__invoke(new CreateUserRequest($id, $company_id, $name, $email, $token, $password, $status));

        return new Response('', Response::HTTP_CREATED);
    }
}
