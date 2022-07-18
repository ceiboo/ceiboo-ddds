<?php

declare(strict_types = 1);

namespace Fullajus\Tests\Configuration\Country\Application;

use Fulljaus\Configuration\Countries\Application\CountryCreator;
use Fulljaus\Configuration\Countries\Application\CreateCountryRequest;
use Fulljaus\Configuration\Countries\Domain\Repositories\CountryRepository;
use Fulljaus\Configuration\Countries\Domain\Entities\Country;
use Fulljaus\Configuration\Countries\Domain\ValueObjects\CountryId;
use Fulljaus\Configuration\Countries\Domain\ValueObjects\CountryName;
use Fulljaus\Configuration\Countries\Domain\ValueObjects\CountryIso;
use Fulljaus\Configuration\Countries\Domain\ValueObjects\CountryPhonecode;
use Fulljaus\Configuration\Countries\Domain\ValueObjects\CountryStatus;
use PHPUnit\Framework\TestCase;

final class CountryCreatorTest extends TestCase
{
    /** @test */
    public function it_should_create_a_valid_country(): void
    {
        $repository = $this->createMock(CountryRepository::class);
        $creator    = new CountryCreator($repository);

        $id         = 'bbdc339e-bb98-4181-acbe-d2303c3e65ab';
        $name       = 'ARGENTINA';
        $iso        = 'ARG';
        $phonecode  = '54';
        $status     = true;

        $request = new CreateCountryRequest($id, $name, $iso, $phonecode, $status);

        $country = new Country(new CountryId($request->id()),
                                new CountryName($request->name()),
                                new CountryIso($request->iso()),
                                new CountryPhonecode($request->phonecode()),
                                new CountryStatus($request->status()));

        $repository->method('save')->with($country);

        $creator->__invoke($request);
    }
}
