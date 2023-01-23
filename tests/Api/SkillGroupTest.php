<?php

namespace App\Tests\Api;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

class SkillGroupTest extends ApiTestCase
{
    public function testGetCollection(): void
    {
        static::createClient()->request('GET', '/api/skill_groups');

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains(['@id' => '/api/skill_groups']);
    }

    public function testFilterByLangReturnsTwoResults(): void
    {
        $response = static::createClient()->request('GET', '/api/skill_groups?lang.slug=fr', [
            'headers' => ['accept' => "application/json"]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertSame(2, sizeof($response->toArray()));
    }

    public function testFilterByWrongLangReturnsNoResult(): void
    {
        

        $response = static::createClient()->request('GET', '/api/skill_groups?lang.slug=en', [
            'headers' => ['accept' => "application/json"]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertSame(0, sizeof($response->toArray()));
    }
}
