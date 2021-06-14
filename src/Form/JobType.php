<?php

namespace App\Form;

use App\Entity\Job;
use App\Entity\Company;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class JobType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('post', TextType::class, [
                'label' => 'Poste',
                'attr' => [
                    'placeholder' => 'Saisir un poste'
                ]
            ])
            ->add('registeredAt', DateType::class, [
                'label' => 'Date d\'enregistrement',
            ])
            ->add('startAt', DateType::class, [
                'label' => 'Date de debut',
            ])
            ->add('endAt', DateType::class, [
                'label' => 'Date de fin',
            ])
            ->add('hoursAWeek', NumberType::class, [
                'label' => 'Heure par semaine',
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
                'attr' => [
                    'placeholder' => 'Saisir une ville'
                ]
            ])
            ->add('postalCode', TextType::class, [
                'label' => 'Code postal',
                'attr' => [
                    'placeholder' => 'Saisir une code postal'
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Message',
                'attr' => [
                    'placeholder' => 'Votre message'
                ]
            ])
            ->add('company', EntityType::class, [
                'class' => Company::class,
                'choice_label' => 'companyName',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Job::class,
        ]);
    }
}
