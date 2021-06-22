<?php

namespace App\Controller\Admin;

use App\Entity\TypeData;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TypeDataCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeData::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
