<?php

namespace App\Form;

use App\Entity\CategoryDonnees;
use App\Entity\Documenttype;
use App\Entity\DonneesType;
use App\Entity\Users;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\DocumentType;

class DocumenttypeType extends AbstractType
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
            ->add('donneesType', EntityType::class,[
                'class' => DonneesType::class,
                'placeholder' => 'Choisir un type de document',

            ])
            //->add('donneesType')
            ->add('title',TextType::class)
            ->add('resume', TextareaType::class)
            //->add('picture', FileType::class)
            ->add('document', DocumentType::class, array(
                'required' =>  false,
                'disabled' => false,
                'attr'     => array('class' => '' , 'disabled' => false),
                'label_attr' => array('class' => '' )
            ))
            // ->add('createdAt')
            ->add('startCreatedAt', DateType::class)
            ->add('endCreatedAt', DateType::class)
            ->add('author')
            ->add('Valider', SubmitType::class)
        ;

        $formModifier = function(FormInterface $form, CategoryDonnees $category =null){
            $donneesType = null === $category ? [] : $category->getDonneesTypes();
            $form ->add('donneesType', EntityType::class, [
                'class' => DonneesType::class,
                'choices' =>$donneesType,
                'choice_label' => 'name',
                'placeholder' => 'Type de document (Choisir)',
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
    /*
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('resume')
            ->add('picture')
            ->add('createdAt')
            ->add('startCreatedAt')
            ->add('endCreatedAt')
            ->add('author')
            ->add('donneesType')
            ->add('categorydonnees')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Documenttype::class,
        ]);
    }*/
}
