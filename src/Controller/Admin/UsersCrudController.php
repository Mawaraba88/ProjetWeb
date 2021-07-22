<?php

namespace App\Controller\Admin;

use App\Entity\Users;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UsersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Users::class;
    }


   /*  public function configureFields(string $pageName): iterable
     {

         return [
            IdField::new('id')->hideOnForm(),
             TextField::new('username'),
             TextField::new('firstname'),
             TextField::new('lastname'),
             AssociationField::new('partners'),
             TextField::new('studylevel'),
             EmailField::new('email'),



             //TextEditorField::new('description'),
         ];
     }*/


}
