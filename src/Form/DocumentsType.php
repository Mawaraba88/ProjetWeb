<?php

namespace App\Form;

use App\Entity\CategoryDonnees;
use App\Entity\Documenttype;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class DocumentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categorydonnees', EntityType::class,[
                //'mapped' => false,
                'class' =>CategoryDonnees::class,
                'choice_label' => 'name',
                'placeholder' => 'Choisir une catégorie',
                'label' => 'Category'
                ])
          /*  ->add('donneesType', ChoiceType::class,[
                'placeholder' => 'Type de document (Choisir un type de document)'
            ])
            ->add('donneesType')*/
          ->add('title',TextType::class)
            ->add('resume', TextareaType::class)
            //->add('picture')
            //->add('file', FileType::class)
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


            ->add('author',EntityType::class, [

                'class'=>User::class,
                'multiple'=> true,
                'attr'=>[
                    'class'=>'js-author-multiple'
                ]
            ])

            ->add('durationOfPublication')
           // ->add('Valider', SubmitType::class)
        ;
/*
        $formModifier = function(FormInterface $form, CategoryDonnees $category =null){
            $donneesType = null === $category ? [] : $category->getDonneesTypes();
            $form ->add('donneesType', EntityType::class, [
                'class' => DonneesType::class,
                'choices' =>$donneesType,
                'choice_label' => 'name',
                'placeholder' => 'Type de document (choisir)',
                'label' => 'Type de document'
            ]);
        };
        $builder->get('categorydonnees')->addEventListener(FormEvents::POST_SUBMIT,
        function(FormEvent $event) use ($formModifier){
            $category = $event->getForm()->getData();
            $formModifier ($event->getForm()->getParent(), $category);
        }
        );
*/
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Documenttype::class,
        ]);
    }
}
