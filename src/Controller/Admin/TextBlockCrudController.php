<?php

namespace App\Controller\Admin;

use App\Entity\TextBlock;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TextBlockCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TextBlock::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('slug'),
            TextField::new('title'),
            TextEditorField::new('content')->setTrixEditorConfig([
                'text_attributes' => [
                    'href' => ['tagName' => 'p', 'target' => '_blank'],
                ]
            ]),
            AssociationField::new('lang'),
        ];
    }
}
