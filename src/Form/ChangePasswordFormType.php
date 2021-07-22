<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ChangePasswordFormType extends AbstractType
{
    /*
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
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
                    'label' => 'New password',
                ],
                'second_options' => [
                    'attr' => ['autocomplete' => 'new-password'],
                    'label' => 'Repeat Password',
                ],
                'invalid_message' => 'The password fields must match.',
                // Instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
*/


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('firstname', TextType::class,[

                'disabled' => true,
                'label' =>'Mon prénom'
            ])
            ->add('lastname', TextType::class,[
                'disabled' => true,
                'label' =>'Mon nom'
            ])
            ->add('email',EmailType::class, [
                'disabled' => true,
                'label' =>'Mon email'
            ])
            ->add('old_password', PasswordType::class,[
                'label' =>'Mon mot de passe actuel',
                'mapped' =>false,
                'attr' => [
                    'placeholder' => 'Veuillez saisir votre mot de passe actuel'
                ]
            ])
            ->add('new_password', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' =>false,
                'invalid_message' => 'Les deux mots de passe doivent être identiques',
                'label' => "Mon nouveau mot de passe",
                'required' => true,
                'first_options' =>[
                    'label' => 'Mon nouveau Mot de passe',
                    'attr' => [
                        'placeholder' =>'Saisir votre mot de passe'
                    ]
                ],
                'second_options' => [
                    'label' => 'Confirmez votre nouveau mot de passe',
                    'attr' => [
                        'placeholder' =>'Confirmez votre nouveau mot de passe'
                    ]
                ]

            ])
            ->add('submit', SubmitType::class, [
                'label' => "Mettre à jour"
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
