<?php

namespace App\Tests\Api;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

class ProfileInformationTest extends ApiTestCase
{
    public function testGetCollection(): void
    {
        static::createClient()->request('GET', '/api/profile_informations');

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains(['@id' => '/api/profile_informations']);
    }

    public function testFilterByLangReturnsTwoResults(): void
    {
        $response = static::createClient()->request('GET', '/api/profile_informations?langs.slug[]=fr', [
            'headers' => ['accept' => "application/json"]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertSame(4, sizeof($response->toArray()));
    }

    public function testFilterByWrongLangReturnsNoResult(): void
    {
        $response = static::createClient()->request('GET', '/api/profile_informations?langs.slug[]=es', [
            'headers' => ['accept' => "application/json"]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertSame(0, sizeof($response->toArray()));
    }

    public function testPrivateInfoIsHidden(): void
    {
        $response = static::createClient()->request('GET', '/api/profile_informations?slug=birthday', [
            'headers' => ['accept' => "application/json"]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertSame(2, sizeof($response->toArray()));
        $this->assertSame('', $response->toArray()[0]['value']);
    }

    public function testPublicInfoIsExposed(): void
    {
        $response = static::createClient()->request('GET', '/api/profile_informations?slug=name', [
            'headers' => ['accept' => "application/json"]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertSame(1, sizeof($response->toArray()));
        $this->assertSame('Cédric Wagner', $response->toArray()[0]['value']);
    }
}
