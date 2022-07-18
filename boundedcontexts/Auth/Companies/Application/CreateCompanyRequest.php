<?php

declare(strict_types = 1);

namespace Ceiboo\Auth\Companies\Application;

final class CreateCompanyRequest
{
    private $id;
    private $name;
    private $address;
    private $country;
    private $status;

    public function __construct(string $id, string $name, string $address, string $country, ?string $status)
    {
        $this->id       = $id;
        $this->name     = $name;
        $this->address  = $address;
        $this->country  = $country;
        $this->status   = $status;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function address(): string
    {
        return $this->address;
    }

    public function country(): string
    {
        return $this->country;
    }

    public function status(): ?string
    {
        return $this->status;
    }
}
