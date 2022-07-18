<?php

declare(strict_types = 1);

namespace Ceiboo\Auth\Companies\Domain\Entities;

use Ceiboo\Auth\Companies\Domain\ValueObjects\CompanyId;
use Ceiboo\Auth\Companies\Domain\ValueObjects\CompanyName;
use Ceiboo\Auth\Companies\Domain\ValueObjects\CompanyAddress;
use Ceiboo\Auth\Companies\Domain\ValueObjects\CompanyCountry;
use Ceiboo\Auth\Companies\Domain\ValueObjects\CompanyStatus;
use Ceiboo\Shared\Domain\Aggregate\AggregateRoot;

final class Company extends AggregateRoot
{
    private $id;
    private $name;
    private $address;
    private $country;
    private $status;

    public function __construct(CompanyId $id,
                                CompanyName $name,
                                CompanyAddress $address,
                                CompanyCountry $country,
                                CompanyStatus $status)
    {
        $this->id       = $id;
        $this->name     = $name;
        $this->address  = $address;
        $this->country= $country;
        $this->status   = $status;
    }

    public static function create(CompanyId $id,
                                CompanyName $name,
                                CompanyAddress $address,
                                CompanyCountry $country,
                                CompanyStatus $status): self
    {
        $company = new self($id, $name, $address, $country, $status);

        //$company->record(new CompanyCreatedDomainEvent($id->value(), $name->value(), $address->value(), $country->value(), $status->value()));

        return $company;
    }

    public function id(): CompanyId
    {
        return $this->id;
    }

    public function name(): CompanyName
    {
        return $this->name;
    }

    public function address(): CompanyAddress
    {
        return $this->address;
    }

    public function country(): CompanyCountry
    {
        return $this->country;
    }

    public function status(): CompanyStatus
    {
        return $this->status;
    }
}
