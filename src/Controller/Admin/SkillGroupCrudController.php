<?php

namespace App\Controller\Admin;

use App\Entity\SkillGroup;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class SkillGroupCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SkillGroup::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $fields = (array) parent::configureFields($pageName);
        $fields[] = AssociationField::new('lang');

        return $fields;
    }
}
