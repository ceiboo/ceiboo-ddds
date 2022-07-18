<?php

declare(strict_types = 1);

namespace Ceiboo\Apps\Backend\Auth\Controller\Status;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class StatusGetController
{

    public function __invoke(Request $request): Response
    {
        return new JsonResponse(
            [
                'api backend auth' => 'ok',
            ]
        );
    }
}
