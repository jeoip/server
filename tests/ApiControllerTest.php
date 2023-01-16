<?php

namespace Tests;

use Jeoip\Ip2Location\Models\SubnetV4;
use Laravel\Lumen\Testing\DatabaseMigrations;

class ApiControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function testQuery()
    {
        SubnetV4::factory()->create();

        $this->json('GET', route('ip.info', ['ip' => '1.1.1.1']))
            ->seeJsonContains([
                'status' => true,
            ])
            ->seeJsonStructure([
                'countryCode',
                'subnet',
                'country',
                'country_eu',
                'region',
                'city',
                'asn',
                'asn_org',
                'latitude',
                'longitude',
                'zipcode',
                'timezone',
                'user_agent',
                'hostname',
                'status',
            ]);

        $this->assertResponseStatus(200);
    }

    public function testIp()
    {
        $this->get(route('ip.ip'));
        $this->assertResponseStatus(200);
    }

    public function testCountry()
    {
        SubnetV4::factory()->create();

        $this->get(route('ip.country', ['ip' => '1.1.1.1']));
        $this->assertResponseStatus(200);
    }

    public function testCountryCode()
    {
        SubnetV4::factory()->create();

        $this->get(route('ip.countryCode', ['ip' => '1.1.1.1']));
        $this->assertResponseStatus(200);
    }

    public function testCity()
    {
        SubnetV4::factory()->create();

        $this->get(route('ip.city', ['ip' => '1.1.1.1']));
        $this->assertResponseStatus(200);
    }

    public function testAsn()
    {
        SubnetV4::factory()->create();

        $this->get(route('ip.asn', ['ip' => '1.1.1.1']));
        $this->assertResponseStatus(200);
    }
}
