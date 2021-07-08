<?php

namespace App\Form;

use App\Entity\Student;
use App\Form\RegistrationFormType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class StudentEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('RegistrationFormType', RegistrationFormType::class, [
                'label' => ''
            ])
            ->add('Level', TextType::class, [
                'label' => ' Niveau d\'étude'
            ])
            ->add('Birthdate', DateType::class, [
                'label' => 'Date de naissance',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}
