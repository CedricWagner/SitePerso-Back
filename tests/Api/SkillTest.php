<?php

namespace App\Tests\Api;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Repository\SkillGroupRepository;

class SkillTest extends ApiTestCase
{
    public function testGetCollection(): void
    {
        static::createClient()->request('GET', '/api/skills');

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains(['@id' => '/api/skills']);
    }

    public function testFilterByLangReturnsThreeItems(): void
    {
        $response = static::createClient()->request('GET', '/api/skills?lang.slug=fr', [
            'headers' => ['accept' => "application/json"]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertSame(3, sizeof($response->toArray()));
    }

    public function testFilterByWrongLangReturnsNoItem(): void
    {
        $response = static::createClient()->request('GET', '/api/skills?lang.slug=en', [
            'headers' => ['accept' => "application/json"]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertSame(0, sizeof($response->toArray()));
    }

    public function testFilterBySkillGroupReturnsTwoItems(): void
    {
        /** @var SkillGroupRepository */
        $groupRepository = static::getContainer()->get(SkillGroupRepository::class);
        $skillGroup = $groupRepository->findOneBy(['name' => 'Languages de programmation']);

        $response = static::createClient()->request('GET', '/api/skills?lang.slug=fr&skillGroup.id=' . $skillGroup->getId(), [
            'headers' => ['accept' => "application/json"]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertSame(2, sizeof($response->toArray()));
    }
}
