<?php

declare(strict_types = 1);

namespace Ceiboo\Auth\Companies\Application;

use Ceiboo\Auth\Companies\Application\CreateCompanyRequest;
use Ceiboo\Auth\Companies\Domain\Repositories\CompanyRepository;
use Ceiboo\Auth\Companies\Domain\Entities\Company;
use Ceiboo\Auth\Companies\Domain\ValueObjects\CompanyId;
use Ceiboo\Auth\Companies\Domain\ValueObjects\CompanyName;
use Ceiboo\Auth\Companies\Domain\ValueObjects\CompanyAddress;
use Ceiboo\Auth\Companies\Domain\ValueObjects\CompanyCountry;
use Ceiboo\Auth\Companies\Domain\ValueObjects\CompanyStatus;

final class CompanyCreator {

    private $repository;

    public function __construct(CompanyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(CreateCompanyRequest $request)
    {
        $id         = new CompanyId($request->id());
        $name       = new CompanyName($request->name());
        $address    = new CompanyAddress($request->address());
        $country    = new CompanyCountry($request->country());
        $status     = new CompanyStatus($request->status());

        $company = new Company($id, $name, $address, $country, $status);

        $this->repository->save($company);
    }
}
