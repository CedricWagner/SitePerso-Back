<?php

namespace App\Tests;

use App\Entity\Admin;
use App\Entity\User;
use App\Repository\AdminRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Guard\Token\PostAuthenticationGuardToken;

abstract class AbstractFunctionalTest extends WebTestCase
{
    /** @var KernelBrowser */
    protected $client;

    protected function setUp(): void
    {
        // $kernel = self::bootKernel();

        $this->client = static::createClient();
        $this->client->enableProfiler();
        $this->client->followRedirects();
    }

    protected function tearDown(): void {
        parent::tearDown();
    }

    public function logIn(string $email = 'test@test.fr'): Admin|null {
        /** @var AdminRepository */
        $adminRepository = static::getContainer()->get(AdminRepository::class);

        // retrieve the test user
        $testAdmin = $adminRepository->findOneByEmail($email);
        if ($testAdmin) {
            $this->client->loginUser($testAdmin);
            return $testAdmin;
        } 

        return null;
    } 

}
