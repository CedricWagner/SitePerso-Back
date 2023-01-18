<?php

namespace App\DataFixtures;

use App\Entity\Experience;
use App\Entity\Lang;
use App\Repository\LangRepository;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ExperienceFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {
        /** @var LangRepository */
        $langRepository = $manager->getRepository(Lang::class);

        $exp = new Experience();
        $exp->setOrganization('LastXp Corp')
            ->setType('CDI')
            ->setDuration('2 ans')
            ->setStartDate(new DateTime('2020-08-14'))
            ->setRole('Lead Dev')
            ->setDescription('<div><p>Description goes <b>here</b></p></div>')
            ->setLang($langRepository->findOneBy([
                'slug' => 'fr'
            ]));
            
        $manager->persist($exp);

        $exp = new Experience();
        $exp->setOrganization('FirstXp Corp')
            ->setType('CDD')
            ->setDuration('1 ans')
            ->setStartDate(new DateTime('2018-08-14'))
            ->setRole('Consultant')
            ->setDescription('<div><p>Description also goes <b>here</b></p></div>')
            ->setLang($langRepository->findOneBy([
                'slug' => 'fr'
            ]));
            
        $manager->persist($exp);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            LangFixtures::class,
        ];
    }
}
