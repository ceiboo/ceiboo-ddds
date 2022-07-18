<?php

declare(strict_types = 1);

namespace Fullajus\Tests\Configuration\Countries\Infrastructure;

use Fulljaus\Configuration\Countries\Domain\Entities\Country;
use Fulljaus\Configuration\Countries\Domain\ValueObjects\CountryId;
use Fulljaus\Configuration\Countries\Domain\ValueObjects\CountryName;
use Fulljaus\Configuration\Countries\Domain\ValueObjects\CountryIso;
use Fulljaus\Configuration\Countries\Domain\ValueObjects\CountryPhonecode;
use Fulljaus\Configuration\Countries\Domain\ValueObjects\CountryStatus;
use Fulljaus\Configuration\Countries\Infrastructure\FileCountryRepository;

use PHPUnit\Framework\TestCase;

final class FileCountryRepositoryTest extends TestCase
{
    /** @test */
    public function it_should_create_a_country(): void
    {
        $id         = new CountryId('bbdc339e-bb98-4181-acbe-d2303c3e65ab');
        $name       = new CountryName('ARGENTINA');
        $iso        = new CountryIso('ARG');
        $phonecode  = new CountryPhonecode('54');
        $status     = new CountryStatus(true);

        $fileCountryRepository = new FileCountryRepository();
        $country = new Country($id, $name, $iso, $phonecode, $status);

        $fileCountryRepository->save($country);
    }
}
