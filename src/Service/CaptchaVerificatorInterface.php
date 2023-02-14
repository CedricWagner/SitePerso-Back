<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;

interface CaptchaVerificatorInterface
{
    public function verify(string $token): bool;
}
