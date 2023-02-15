<?php

namespace App\DataFixtures;

use App\Entity\Lang;
use App\Entity\ProfileInformation;
use App\Repository\LangRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProfileInformationFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        /** @var LangRepository */
        $langRepository = $manager->getRepository(Lang::class);
        /** @var Lang */
        $langFr = $langRepository->findOneBy(['slug' => 'fr']);
        /** @var Lang */
        $langEn = $langRepository->findOneBy(['slug' => 'en']);

        $info = new ProfileInformation();
        $info->setSlug('name')
            ->setValue('Cédric Wagner')
            ->setIsPrivate(false)
            ->addLang($langFr)
            ->addLang($langEn);
        $manager->persist($info);

        $info = new ProfileInformation();
        $info->setSlug('birthday')
            ->setValue('14/08/1990')
            ->setIsPrivate(true)
            ->addLang($langFr);
        $manager->persist($info);

        $info = new ProfileInformation();
        $info->setSlug('birthday')
            ->setValue('1990-08-14')
            ->setIsPrivate(true)
            ->addLang($langEn);
        $manager->persist($info);

        $info = new ProfileInformation();
        $info->setSlug('github')
            ->setValue('https://github.com/CedricWagner')
            ->setIsPrivate(false)
            ->addLang($langFr)
            ->addLang($langEn);
        $manager->persist($info);

        $info = new ProfileInformation();
        $info->setSlug('role')
            ->setValue('Développeur Web / Fullstack')
            ->setIsPrivate(false)
            ->addLang($langFr);
        $manager->persist($info);

        $info = new ProfileInformation();
        $info->setSlug('role')
            ->setValue('Fullstack Web Developer')
            ->setIsPrivate(false)
            ->addLang($langEn);
        $manager->persist($info);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            LangFixtures::class,
        ];
    }
}
