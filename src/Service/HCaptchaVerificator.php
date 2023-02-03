<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HCaptchaVerificator implements CaptchaVerificatorInterface{
    private $httpClient;
    private $secret;
    private $hcaptchaVerifyUrl;

    public function __construct($secret)
    {
        $this->secret = $secret;
        $this->httpClient = HttpClient::create();
        $this->hcaptchaVerifyUrl = 'https://hcaptcha.com/siteverify';
    }

    public function verify(string $token): bool {
        $response = $this->httpClient->request('POST', $this->hcaptchaVerifyUrl, [
            'body' => [
                'response' => $token,
                'secret' => $this->secret 
            ]
        ]);

        $jsonResponse = json_decode($response->getContent());

        return $jsonResponse->success;
    }

}