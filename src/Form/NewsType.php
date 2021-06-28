<?php

namespace App\Form;

use App\Entity\Documenttype;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('donneesType')
            ->add('title')
            ->add('resume')
            ->add('picture', FileType::class)
            ->add('startCreatedAt')
            ->add('endCreatedAt')
            ->add('place')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Documenttype::class,
        ]);
    }
}
