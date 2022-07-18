<?php

declare(strict_types = 1);

namespace Ceiboo\Apps\Backend\Auth\Controller\Companies;

use Ceiboo\Auth\Companies\Application\CompanyCreator;
use Ceiboo\Auth\Companies\Application\CreateCompanyRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class CompaniesPutController
{
    private $creator;

    public function __construct(CompanyCreator $creator)
    {
        $this->creator = $creator;
    }

    public function __invoke(string $id, Request $request): Response
    {
        $name = $request->request->get('name');
        $address = $request->request->get('address');
        $country = $request->request->get('country');
        $status = $request->request->get('status');

        $this->creator->__invoke(new CreateCompanyRequest($id, $name, $address, $country, $status));

        return new Response('', Response::HTTP_CREATED);
    }
}
