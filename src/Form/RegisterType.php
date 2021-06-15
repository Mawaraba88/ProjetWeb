<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('phone')
           // ->add('field')
           // ->add('institution')
           // ->add('studylevel')
           // ->add('researchsubject')
          //  ->add('address')
            ->add('email')
            ->add('password', PasswordType::class)
            ->add('passwordConfirm', PasswordType::class)
            //->add('documenttypes')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
