<?php

namespace App\Form;

use App\Entity\CategoryNews;
use App\Entity\News;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;


class NewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categorynews', EntityType::class,[
                'class' =>CategoryNews::class,
                'choice_label' => 'name',
                'placeholder' => 'Choisir une catégorie',
                'label' => 'Category'
            ])

            ->add('title',TextType::class)
            ->add('resume', TextareaType::class)
            ->add('place', TextType::class)
            ->add('startCreatedAt', DateType::class, [
                'label' =>'Date de début',
                'required'=>false,
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd'])

            ->add('endCreatedAt', DateType::class, [
                'label' =>'Date de fin',
                'required'=>false,
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd'])


            ->add('duration_of_publication', DateType::class, [
                'label' =>'Durée de publication',
                'required'=>false,
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd'])
/*

            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => true,
                'download_uri' => false,


            ])

            ->add('brochureFile', VichFileType::class, [
                'required' => false,
                'allow_delete' => true,
                //'delete_label' => '...',
                'download_uri' => false,
                // 'download_label' => '...',

            ])
*/
            ->add('authors')
            ->add('durationOfPublication')
            ->add('Valider', SubmitType::class)
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => News::class,
        ]);
    }
}
