<?php

namespace App\Controller\Admin;

use App\Entity\Skill;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class SkillCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Skill::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $fields = (array) parent::configureFields($pageName);
        $fields[] = AssociationField::new('skillGroup');
        $fields[] = AssociationField::new('lang');

        return $fields;
    }
}
