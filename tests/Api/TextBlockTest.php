<?php

namespace App\Tests\Api;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\TextBlock;

class TextBlockTest extends ApiTestCase
{
    public function testGetCollection(): void
    {
        static::createClient()->request('GET', '/api/text_blocks');

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains(['@id' => '/api/text_blocks']);
    }

    public function testFilterBySlugAndLangReturnsOneResult(): void
    {
        $client = static::createClient();

        $response = $client->request('GET', '/api/text_blocks?slug=about&lang.slug=fr', [
            'headers' => ['accept' => "application/json"]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertSame(1, sizeof($response->toArray()));
    }

    public function testFilterByWrongSlugReturnsNoResult(): void
    {
        $client = static::createClient();

        $response = $client->request('GET', '/api/text_blocks?slug=aabout&lang.slug=fr', [
            'headers' => ['accept' => "application/json"]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertSame(0, sizeof($response->toArray()));
    }

    public function testFilterByWrongLangReturnsNoResult(): void
    {
        $client = static::createClient();

        $response = $client->request('GET', '/api/text_blocks?slug=about&lang.slug=en', [
            'headers' => ['accept' => "application/json"]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertSame(0, sizeof($response->toArray()));
    }
}
