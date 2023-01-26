<?php

namespace App\Tests\Api;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

class TrainingTest extends ApiTestCase
{
    public function testGetCollection(): void
    {
        static::createClient()->request('GET', '/api/trainings');

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains(['@id' => '/api/trainings']);
    }

    public function testFilterByLangReturnsTwoResults(): void
    {
        $client = static::createClient();

        $response = $client->request('GET', '/api/trainings?lang.slug=fr', [
            'headers' => ['accept' => "application/json"]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertSame(2, sizeof($response->toArray()));
    }

    public function testFilterByWrongLangReturnsNoResult(): void
    {
        $client = static::createClient();

        $response = $client->request('GET', '/api/trainings?lang.slug=en', [
            'headers' => ['accept' => "application/json"]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertSame(0, sizeof($response->toArray()));
    }
}
