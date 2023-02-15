<?php

namespace App\DataFixtures;

use App\Entity\Lang;
use App\Entity\TextBlock;
use App\Repository\LangRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class TextBlockFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        /** @var LangRepository */
        $langRepository = $manager->getRepository(Lang::class);

        $textBlock = new TextBlock();
        $textBlock->setContent('<div><p>[Texte de présentation]</p></div>')
            ->setLang($langRepository->findOneBy([
                'slug' => 'fr'
            ]))
            ->setTitle('Ma présentation')
            ->setSlug('about');
        $manager->persist($textBlock);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            LangFixtures::class,
        ];
    }
}
