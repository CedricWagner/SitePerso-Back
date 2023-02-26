<?php

namespace App\Tests\Command;

use App\Entity\Admin;
use App\Repository\AdminRepository;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class AdminCreateCommandTest extends KernelTestCase
{

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;
    /**
     * @var Symfony\Bundle\FrameworkBundle\Console\Application
     */
    private $application;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
        $this->application = new Application($kernel);
    }

    public function testExecute() 
    {

        $command = $this->application->find('app:admin:create');
        $commandTester = new CommandTester($command);
        $commandTester->setInputs(['123']); // prompt password
        $commandTester->execute([
            'email' => 'new@dmin.com',
        ]);

        /** @var AdminRepository */
        $adminRepository = $this->entityManager->getRepository(Admin::class);
        $newAdmin = $adminRepository->findOneByEmail('new@dmin.com');

        $commandTester->assertCommandIsSuccessful();

        $this->assertNotNull($newAdmin);
        $this->assertEquals($newAdmin->getEmail(), 'new@dmin.com');
        $this->assertEquals($newAdmin->getRoles(), ['ROLE_ADMIN', 'ROLE_USER']);
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('new@dmin.com', $output);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null;
    }

}