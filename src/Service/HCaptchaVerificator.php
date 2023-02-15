<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HCaptchaVerificator implements CaptchaVerificatorInterface
{
    private HttpClientInterface $httpClient;
    private string $hcaptchaVerifyUrl;

    public function __construct(private string $secret)
    {
        $this->httpClient = HttpClient::create();
        $this->hcaptchaVerifyUrl = 'https://hcaptcha.com/siteverify';
    }

    public function verify(string $token): bool
    {
        $response = $this->httpClient->request('POST', $this->hcaptchaVerifyUrl, [
            'body' => [
                'response' => $token,
                'secret' => $this->secret
            ]
        ]);

        /** @var \stdClass */
        $jsonResponse = json_decode($response->getContent());

        return $jsonResponse->success;
    }
}
