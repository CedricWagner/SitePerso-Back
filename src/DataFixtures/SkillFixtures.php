<?php

namespace App\DataFixtures;

use App\Entity\Lang;
use App\Entity\Skill;
use App\Entity\SkillGroup;
use App\Repository\LangRepository;
use App\Repository\SkillGroupRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SkillFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        /** @var LangRepository */
        $langRepository = $manager->getRepository(Lang::class);
        $langFr = $langRepository->findOneBy(['slug' => 'fr']);
        /** @var SkillGroupRepository */
        $groupRepository = $manager->getRepository(SkillGroup::class);

        $skill = new Skill();
        $skill->setName('PHP')
            ->setSkillGroup($groupRepository->findOneBy(['name' => 'Languages de programmation']))
            ->setLang($langFr)
            ->setWeight(1)
            ->setRating(9)
            ->setDetails('Maitrise de PHP, jusqu\'à PHP 8.x');
        $manager->persist($skill);

        $skill = new Skill();
        $skill->setName('Javascript')
            ->setSkillGroup($groupRepository->findOneBy(['name' => 'Languages de programmation']))
            ->setLang($langFr)
            ->setWeight(2)
            ->setRating(8)
            ->setDetails('Bonne maitrise de Javascript, quelques lacunes');
        $manager->persist($skill);

        $skill = new Skill();
        $skill->setName('Symfony')
            ->setSkillGroup($groupRepository->findOneBy(['name' => 'Frameworks']))
            ->setLang($langFr)
            ->setWeight(1)
            ->setRating(8)
            ->setDetails('...');
        $manager->persist($skill);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            LangFixtures::class,
            SkillGroupFixtures::class,
        ];
    }
}
