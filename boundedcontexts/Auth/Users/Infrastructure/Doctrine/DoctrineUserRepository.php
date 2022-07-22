<?php

declare(strict_types = 1);

namespace Ceiboo\Auth\Users\Infrastructure\Doctrine;

use Ceiboo\Auth\Users\Domain\Entities\User;
use Ceiboo\Auth\Users\Domain\ValueObjects\UserId;
use Ceiboo\Auth\Users\Domain\Repositories\UserRepository;
use Doctrine\ORM\EntityManager;

//use Fulljaus\Shared\Infrastructure\Doctrine\DoctrineRepository;

//final class DoctrineCompanyRepository extends DoctrineRepository implements CompanyRepository
final class DoctrineUserRepository implements UserRepository
{
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function save(User $user): void
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush($user);
    }

    public function search(UserId $id): ?User
    {
        return $this->entityManager->getRepository(User::class)->find($id);
    }
}
