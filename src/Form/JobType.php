<?php

namespace App\Form;

use App\Entity\Job;
use App\Entity\Company;
use App\Entity\StudyField;
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
            ->add('studyField', EntityType::class, [
                'class' => StudyField::class,
                'choice_label' => 'studyFieldName',
                'label' => 'Domaine',
                'multiple' => false,
                'expanded' => false,
            ])
            ->add('startAt', DateType::class, [
                'label' => 'Date de debut',
            ])
            ->add('endAt', DateType::class, [
                'label' => 'Date de fin',
            ])
            ->add('hoursAWeek', NumberType::class, [
                'label' => 'Heures par semaine',
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
                    'placeholder' => 'Saisir un code postal'
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description de l\'offre',
                'attr' => [
                    'placeholder' => 'Saisir une description'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Job::class,
        ]);
    }
}
