<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AdminFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        $admin = new Admin();
        $admin->setEmail('test@test.fr')
            ->setPassword('$2y$13$WQMyoFKvu719ka0IPkB2OecZuUt9u85PZouwe21XpgR1Q3D4J9nx6') // "admin"
            ->setRoles(["ROLE_ADMIN"]);
        $manager->persist($admin);

        $manager->flush();
    }
}
