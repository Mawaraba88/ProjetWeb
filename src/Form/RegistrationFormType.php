<?php

namespace App\Form;

use App\Entity\Partners;
use App\Entity\User;

use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use function Sodium\add;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('firstname', Texttype::class, [
        'label'=>"Votre prénom",
        'constraints' => new length([
            'min'=> 2,
            'max'=> 30]),
        'attr'=>[
            'placeholder' => 'Saisir votre prénom'
        ]
    ])
            ->add('lastname',TextType::class, [
                'label' => "Votre nom",
                'constraints' => new length([
                    'min'=> 2,
                    'max'=> 30]),
                'attr' => [
                    'placeholder' => 'Saisir votre nom'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => "Votre email",
                'constraints' => new length([
                    'min'=> 2,
                    'max'=> 55]),
                'attr' => [
                    'placeholder' =>'Saisir votre email'
                ]
            ])

           /* ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])*/
            ->add('plainPassword', RepeatedType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'type' => PasswordType::class,
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                'first_options' =>[
                    'label' => 'Mot de passe',
                    'attr' => [
                        'placeholder' =>'Saisir votre mot de passe'
                    ]
                ],
                'second_options' => [
                    'label' => 'Confirmez votre mot de passe',
                    'attr' => [
                        'placeholder' =>'Confirmez votre mot de passe'
                    ]
                    ]
            ])
           /* ->add('partners', ChoiceType::class, [
                'choices' =>$this->getChoice(),
                'required' =>false
            ])*/
           ->add('partners',EntityType::class, [
               'class'=>Partners::class,
               'multiple' =>true,
               'attr' =>[
                   'class'=>'js-partners-multiple'
               ],
               'choice_label' => 'name',
               'placeholder' => 'Sélectionner les partenaires',
               'label' => 'Partners'
           ])

            ->add('studylevel', ChoiceType::class, [
                'choices' =>$this->getChoices(),
                'required' =>false
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }

    private function getChoices()
    {
        $choices = User::STUDYLEVEL;
        $outpout = [];
        foreach ($choices as $k => $v)
        {
            $outpout[$v] = $k;
        }
        return $outpout;
    }
    private function getChoice()
    {
        $choice = User::PARTNERS;
        $outpout = [];
        foreach ($choice as $k => $v)
        {
            $outpout[$v] = $k;
        }
        return $outpout;
    }
}
