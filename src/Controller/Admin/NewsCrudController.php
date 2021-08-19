<?php

namespace App\Controller\Admin;

use App\Entity\News;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class NewsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return News::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('categorynews'),
            TextField::new('title'),
            TextEditorField::new('resume'),
            DateField::new('startCreatedAt'),
            DateField::new('endCreatedAt'),
           ImageField::new('picture')
                ->setBasePath('uploads/')
                ->setUploadDir('public/uploads')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
          /*  ImageField::new('brochureFilename')
                ->setBasePath('brochures/')
                ->setUploadDir('public/uploads/brochures')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),*/

            //TextField::new('imageFile')->setFormType(VichFileType::class)->onlyWhenCreating(),
            //ImageField::new('picture')
            //->setBasePath('uploads/'),
            AssociationField::new('authors'),
            BooleanField::new('isActive'),
        ];
    }

}
