<?php

namespace App\Controller\Admin;

use App\Entity\Documenttype;
use DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\FileUploadType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Vich\UploaderBundle\Form\Type\VichFileType;

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
            AssociationField::new('categorydonnees'),
            ImageField::new('picture')
              ->setBasePath('uploads/')
              ->setUploadDir('public/uploads')
              ->setUploadedFileNamePattern('[randomhash].[extension]')
              ->setRequired(false),
            ImageField::new('brochureFilename')
                ->setBasePath('brochures/')
                ->setUploadDir('public/uploads/brochures')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),

            //TextField::new('imageFile')->setFormType(VichFileType::class)->onlyWhenCreating(),
            //ImageField::new('picture')
            //->setBasePath('uploads/'),
            AssociationField::new('author'),
            BooleanField::new('isActive'),

           // AssociationField::new('donneesType'),
           // DateField:: new('startCreatedAt'),
            //DateField:: new('endCreatedAt')



        ];
    }

}
