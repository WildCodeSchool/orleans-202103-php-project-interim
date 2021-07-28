<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'attr' => [
                    'placeholder' => 'Jean'
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'Dupond'
                ]
            ])
            ->add('phone', TelType::class, [
                'label' => 'Téléphone',
                'attr' => [
                    'placeholder' => '0600000000'
                ]
            ])
            ->add('roles', ChoiceType::class, [
                'label' => 'Etes vous:',
                'invalid_message' => 'Ce statut n\'est pas valide',
                'choices' => [
                    'Etudiant' => 'ROLE_STUDENT',
                    'Entreprise' => 'ROLE_COMPANY',
                ],
                'mapped' => false,
                'multiple' => false,
                'expanded' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Vous devez selectionner un statut.',
                    ]),
                ]
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'placeholder' => 'jean.dupond@Email.fr'
                ]
            ])

            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'attr' => ['autocomplete' => 'new-password','class' => 'form-control'],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Merci d\'entrer votre nouveau mot de passe',
                        ]),
                        new Length([
                            'min' => 6,
                            'minMessage' => 'Votre message doit contenir au minimum {{ limit }} caractères',
                            // max length allowed by Symfony for security reasons
                            'max' => 4096,
                        ]),
                    ],
                    'label' => 'Mot de passe', ],
                'second_options' => [
                    'attr' => ['autocomplete' => 'new-password','class' => 'my-2 form-control'],
                    'label' => 'Répéter mot de passe',
                ],
                'invalid_message' => 'Les champs mot de passe doivent coïncider.',
                // Instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
