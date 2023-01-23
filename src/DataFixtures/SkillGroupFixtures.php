<?php

namespace App\DataFixtures;

use App\Entity\Lang;
use App\Entity\SkillGroup;
use App\Repository\LangRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SkillGroupFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        /** @var LangRepository */
        $langRepository = $manager->getRepository(Lang::class);

        $skillGroup = new SkillGroup();
        $skillGroup->setName('Languages de programmation')
            ->setLang($langRepository->findOneBy(['slug' => 'fr']))
            ->setWeight(1);
        $manager->persist($skillGroup);

        $skillGroup = new SkillGroup();
        $skillGroup->setName('Frameworks')
            ->setLang($langRepository->findOneBy(['slug' => 'fr']))
            ->setWeight(2);
        $manager->persist($skillGroup);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            LangFixtures::class,
        ];
    }
}
