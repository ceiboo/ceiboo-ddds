<?php

declare(strict_types = 1);

namespace Ceiboo\Auth\Companies\Infrastructure\Doctrine;

use Ceiboo\Auth\Companies\Domain\Entities\Company;
use Ceiboo\Auth\Companies\Domain\ValueObjects\CompanyId;
use Ceiboo\Auth\Companies\Domain\Repositories\CompanyRepository;
use Doctrine\ORM\EntityManager;

//use Fulljaus\Shared\Infrastructure\Doctrine\DoctrineRepository;

//final class DoctrineCompanyRepository extends DoctrineRepository implements CompanyRepository
final class DoctrineCompanyRepository implements CompanyRepository
{
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function save(Company $company): void
    {
        $this->entityManager->persist($company);
        $this->entityManager->flush($company);
    }

    public function search(CompanyId $id): ?Company
    {
        return $this->entityManager->getRepository(Company::class)->find($id);
    }
}
