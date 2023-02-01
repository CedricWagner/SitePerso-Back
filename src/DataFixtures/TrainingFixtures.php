<?php

namespace App\DataFixtures;

use App\Entity\Lang;
use App\Entity\Training;
use App\Repository\LangRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TrainingFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        /** @var LangRepository */
        $langRepository = $manager->getRepository(Lang::class);
        $langFr = $langRepository->findOneBy(['slug' => 'fr']);

        $training = new Training();
        $training->setDate('2010')
            ->setDescription('<p>Description du <b>diplome</b>...</p>')
            ->setLang($langFr)
            ->setLocation('Strasbourg')
            ->setName('Lycée...')
            ->setQualification('BTS IG')
            ->setStartDate(new \DateTime('2010-09-01'));
        $manager->persist($training);
        
        $training = new Training();
        $training->setDate('2016')
            ->setDescription('<p>Description du <b>diplome</b>...</p>')
            ->setLang($langFr)
            ->setLocation('Illkirch')
            ->setName('DUT...')
            ->setQualification('Licence pro')
            ->setStartDate(new \DateTime('2016-09-01'));
        $manager->persist($training);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            LangFixtures::class,
        ];
    }
}
