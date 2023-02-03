<?php

namespace App\Controller\Admin;

use App\Entity\ProfileInformation;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;

class ProfileInformationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProfileInformation::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $fields[] = Field::new('slug');
        $fields[] = Field::new('value');
        $fields[] = AssociationField::new('langs')    
            ->formatValue(function ($value, ProfileInformation $item) {
                $langNames = [];
                foreach ($item->getLangs() as $lang) {
                    $langNames[] = $lang->getName();
                }
                return implode(', ', $langNames);
            });

        return $fields;
    }
}
