<?php

namespace App\Form;

use App\Entity\Documenttype;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DocumentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categorydonnees')
            ->add('donneesType')
            ->add('title')
            ->add('resume')
            ->add('picture')
           // ->add('createdAt')
            ->add('startCreatedAt')
            ->add('endCreatedAt')
            ->add('category')
            ->add('author')


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Documenttype::class,
        ]);
    }
}
