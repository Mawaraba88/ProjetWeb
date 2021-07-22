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
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Validator\Constraints\File;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class DocumenttypeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           /* ->add('categorydonnees', EntityType::class,[
               // 'mapped' => false,
                'class' =>CategoryDonnees::class,
                //'choice_label' => 'name',
                'placeholder' => 'Choisir une catégorie',
                'label' => 'Category'
            ])
           */
               ->add('categorydonnees')
           /* ->add('donneesType', EntityType::class,[
                'class' => DonneesType::class,
                'placeholder' => 'Choisir un type de document',

            ])
            //->add('donneesType')
            ->add('title',TextType::class)
            ->add('resume', TextareaType::class)

            /*->add('picture', FileType::class, [
                'label' => false,
                'mapped' =>false,
                'required' => false,


            ])*/
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

/*
            ->add('brochure', FileType::class, [
                'label' => 'Brochure (PDF file)',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PDF document',
                    ])
                ],
            ])*/

           /* ->add('documents', CollectionType::class, [
                'entry_type' => 'App\Form\DocumentType',
                'entry_options' => [
                    'label' => false,
                ],
                'allow_add' => false,
                'allow_delete' => false,
                'by_reference' => false,
            ])
            ->add('document', DocumentType::class, array(
                'required' =>  $reqdocument,
                'disabled' => $mode_lect || $archiverDocument || $supprimerDocument,
                'attr'     => array('class' => $attrdocument.' '. $hidedocument, 'disabled' => $mode_lect),
                'label_attr' => array('class' => $hidedocument . ' ' . $classDocument)
            ))*/

            // ->add('createdAt')

            ->add('author')
            //->add('Valider', SubmitType::class)
        ;
/*
        $formModifier = function(FormInterface $form, CategoryDonnees $category =null){
            $donneesType = null === $category ? [] : $category->getDonneesTypes();
            $form ->add('donneesType', EntityType::class, [
                'class' => DonneesType::class,
                'choices' =>$donneesType,
                'choice_label' => 'name',
                'placeholder' => 'Type de document (Choisir...)',
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
