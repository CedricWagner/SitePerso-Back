<?php

namespace App\DataFixtures;

use App\Entity\Hobby;
use App\Entity\Lang;
use App\Repository\LangRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class HobbyFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        /** @var LangRepository */
        $langRepository = $manager->getRepository(Lang::class);
        $langFr = $langRepository->findOneBy(['slug' => 'fr']);

        $hobby = new Hobby();
        $hobby->setName('Musique')
            ->setLang($langFr)
            ->setDescription('<p>Ecoute et <i>composition</i></p>')
            ->setWeight(1);
        $manager->persist($hobby);

        $hobby = new Hobby();
        $hobby->setName('Escrime')
            ->setLang($langFr)
            ->setDescription('<p>...</p>')
            ->setWeight(2);
        $manager->persist($hobby);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            LangFixtures::class,
        ];
    }
}
