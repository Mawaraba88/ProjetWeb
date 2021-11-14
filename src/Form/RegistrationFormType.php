<?php

namespace App\Form;

use App\Entity\Partners;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Vich\UploaderBundle\Form\Type\VichImageType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder


            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => true,
                'download_uri' => false,


            ])

            ->add('firstname', Texttype::class, [
                'label'=>"Votre prénom",
                'constraints' => new length([
                    'min'=> 2,
                    'max'=> 30])

            ])
            ->add('lastname',TextType::class, [
                'label' => "Votre nom",
                'constraints' => new length([
                    'min'=> 2,
                    'max'=> 30])

            ])
            ->add('email', EmailType::class, [
                'label' => "Votre email",
                'constraints' => new length([
                    'min'=> 2,
                    'max'=> 55])

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
                        'max' => 4096
                    ]),
                ],
                'first_options' =>[
                    'label' => 'Mot de passe',

                ],
                'second_options' => [
                    'label' => 'Confirmez votre mot de passe',

                ]
            ])

            ->add('partners',EntityType::class, [
                'class'=>Partners::class,
                'multiple' =>true,
               // 'placeholder' => 'Sélectionner les partenaires',
                'attr' =>[
                    'class'=>'js-partners-multiple',
                ],
                'choice_label' => 'name',

                'label' => 'Choisir vos Partenaires'
            ])

            ->add('studylevel', ChoiceType::class, [
                'label' =>'Niveau d\'étude',
                'choices' =>$this->getChoices(),
                'required' =>false,

                'placeholder' => 'Choisir votre niveau d\'étude'

            ])
            ->add('phone', TextType::class, [
                'label'=>'Tél'

            ])

            ->add('fieldOfResearch', TextType::class, [
                'label' => 'Champs de recherche'

            ])

            ->add('webSite', TextType::class, [
                'label' => 'Site Web'


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

}
