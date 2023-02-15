<?php

namespace App\Controller\Admin;

use App\Entity\Hobby;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class HobbyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Hobby::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $fields = (array) parent::configureFields($pageName);
        $fields[] = AssociationField::new('lang');
        $fields[] = TextEditorField::new('description');

        return $fields;
    }
}
