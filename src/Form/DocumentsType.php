<?php

namespace App\Form;

use App\Entity\CategoryDonnees;
use App\Entity\Documenttype;
use App\Entity\DonneesType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DocumentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categorydonnees', EntityType::class,[
                'mapped' => false,
                'class' =>CategoryDonnees::class,
                'choice_label' => 'name',
                'placeholder' => 'Choisir une catégorie',
                'label' => 'Category'
                ])
            ->add('donneesType', ChoiceType::class,[
                'placeholder' => 'Type de document (Choisir un type de document)'
            ])
            ->add('donneesType')
            ->add('title')
            ->add('resume')
            //->add('picture')
            ->add('file', FileType::class)
           // ->add('createdAt')
            ->add('startCreatedAt')
            ->add('endCreatedAt')
            ->add('author')
            ->add('Valider', SubmitType::class)
        ;

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
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Documenttype::class,
        ]);
    }
}
