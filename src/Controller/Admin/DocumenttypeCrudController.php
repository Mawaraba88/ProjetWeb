<?php

namespace App\Controller\Admin;

use App\Entity\Documenttype;
use DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DocumenttypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Documenttype::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title'),
            TextEditorField::new('resume'),
            ImageField::new('picture')
              ->setBasePath('uploads/')
              ->setUploadDir('public/uploads')
              ->setUploadedFileNamePattern('[randomhash].[extension]')
              ->setRequired(false),
            AssociationField::new('author'),
            AssociationField::new('category'),
            //AssociationField::new(categorydata),
            AssociationField::new('typeData'),
            DateField:: new('startCreatedAt'),
            DateField:: new('endCreatedAt')



        ];
    }

}
