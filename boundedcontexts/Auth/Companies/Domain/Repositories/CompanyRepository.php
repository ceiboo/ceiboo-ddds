<?php

declare(strict_types = 1);

namespace Ceiboo\Auth\Companies\Domain\Repositories;

use Ceiboo\Auth\Companies\Domain\Entities\Company;
use Ceiboo\Auth\Companies\Domain\ValueObjects\CompanyId;

interface CompanyRepository
{
    public function save(Company $company): void;

    public function search(CompanyId $id): ?Company;
}
