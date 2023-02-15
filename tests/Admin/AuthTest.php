<?php

namespace App\Tests\Admin\Crud;

use App\Repository\LangRepository;
use App\Tests\AbstractFunctionalTest;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AuthTest extends AbstractFunctionalTest
{
    public function testRedirectWhenNotLoggedIn(): void
    {
        // $this->logIn();
        $this->client->request('GET', '/admin');

        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('app_login');
    }

    public function testAdminCanLogIn(): void
    {
        $admin = $this->logIn();
        $this->client->request('GET', '/admin');

        $this->assertSame('test@test.fr', $admin?->getEmail());
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('admin');
    }
}
