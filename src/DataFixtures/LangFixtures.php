<?php

namespace App\DataFixtures;

use App\Entity\Lang;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LangFixtures extends Fixture {
    public function load(ObjectManager $manager)
    {
        $lang = new Lang();
        $lang->setName('French');
        $lang->setSlug('fr');
        $lang->setIsDefault(true);
        $manager->persist($lang);
        
        $lang = new Lang();
        $lang->setName('English');
        $lang->setSlug('en');
        $lang->setIsDefault(false);
        $manager->persist($lang);

        $manager->flush();
    }
}