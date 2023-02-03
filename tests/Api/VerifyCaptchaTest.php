<?php

namespace App\Tests\Api;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use Symfony\Component\HttpFoundation\Response;

class VerifyCaptchaTest extends ApiTestCase
{
    public function testReturnsTrueOnCorrectToken(): void
    {
        $response = static::createClient()->request('POST', '/api/captcha/verify', [
            "body" => '{"clientResponse": "10000000-aaaa-bbbb-cccc-000000000001"}'
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertTrue($response->toArray()['result']);
    }

    public function testReturnsErrorOnIncorrectToken(): void
    {
        $response = static::createClient()->request('POST', '/api/captcha/verify', [
            "body" => '{"clientResponse": "00000000-aaaa-bbbb-cccc-000000000001"}'
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertFalse($response->toArray()['result']);
    }

    public function testReturns400OnMissingToken(): void
    {
        static::createClient()->request('POST', '/api/captcha/verify');

        $this->assertResponseStatusCodeSame(Response::HTTP_BAD_REQUEST);
    }
}