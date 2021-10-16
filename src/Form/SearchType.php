<?php
namespace App\Form;
use App\Classe\Search;
use App\Entity\CategoryDonnees;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    //creation du formulaire
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('string', TextType::class, [
                'label' =>false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Votre recherche par mot clé',
                    'class'=>'form-control-sm'
                ]
            ])

            ->add('searchDate', DateType::class, [
                'label' =>'Par date de création',
                'required'=>false,
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd'
             /*   'placeholder' => [
        'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
    ]*/
            ])



            //pour faire reference à l'entité categorie on appel EntityType en 2ème paramètre
          /*  ->add('categoriesDonnees', EntityType::class, [
                'label'=>false,
                'required'=>false,
                //lien avec la classe
                'class'=>CategoryDonnees::class,
                'multiple'=>true,
                'expanded'=> true

            ])*/

            /*->add('authors', TextType::class, [
                'label'=>false,
                'required'=>false,
                'attr' => [
                    'placeholder' => 'Votre recherche...',
                    'class'=>'form-control-sm'
                ]

            ])
            ->add('submit', SubmitType::class, [
                'label'=>'Filtrer',
                'attr'=>[
                    'class'=>'btn-block btn-info'
                ]

            ])*/
            ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Search::class,
            'method'=> 'GET',
            //desactivation de le crsf protection symfony
            'crsf_protection'=>false,
        ]);
    }

    //fonction
    public function getBlockPrefix()
    {
        return ''; //parent::getBlockPrefix(); // TODO: Change the autogenerated stub
    }
}
