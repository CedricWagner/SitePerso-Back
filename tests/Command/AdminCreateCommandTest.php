<?php

namespace App\Tests\Command;

use App\Entity\Admin;
use App\Repository\AdminRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class AdminCreateCommandTest extends KernelTestCase
{

    /**
     * @var ObjectManager|null
     */
    private $entityManager;
    /**
     * @var Application
     */
    private $application;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        /** @var ManagerRegistry */
        $doctrineRegistry = $kernel->getContainer()->get('doctrine');
        $this->entityManager = $doctrineRegistry->getManager();
        $this->application = new Application($kernel);
    }

    public function testExecute(): void 
    {

        $command = $this->application->find('app:admin:create');
        $commandTester = new CommandTester($command);
        $commandTester->setInputs(['123']); // prompt password
        $commandTester->execute([
            'email' => 'new@dmin.com',
        ]);

        /** @var AdminRepository */
        $adminRepository = $this->entityManager?->getRepository(Admin::class);
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

        $this->entityManager = null;
    }

}