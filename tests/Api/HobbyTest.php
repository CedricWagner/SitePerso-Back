<?php

namespace App\Tests\Api;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

class HobbyTest extends ApiTestCase
{
    public function testGetCollection(): void
    {
        static::createClient()->request('GET', '/api/hobbies');

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains(['@id' => '/api/hobbies']);
    }

    public function testFilterByLangReturnsTwoResults(): void
    {
        $response = static::createClient()->request('GET', '/api/hobbies?lang.slug=fr', [
            'headers' => ['accept' => "application/json"]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertSame(2, sizeof($response->toArray()));
    }

    public function testFilterByWrongLangReturnsNoResult(): void
    {
        

        $response = static::createClient()->request('GET', '/api/hobbies?lang.slug=en', [
            'headers' => ['accept' => "application/json"]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertSame(0, sizeof($response->toArray()));
    }
}
