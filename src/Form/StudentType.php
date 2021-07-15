<?php

namespace App\Form;

use App\Entity\Student;
use Symfony\Component\Form\AbstractType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user', UserEditType::class, [
                'label' => ''
            ])
            ->add('level', TextType::class, [
                'label' => ' Niveau d\'étude'
            ])
            ->add('birthdate', BirthdayType::class, [
                'label' => 'Date de naissance',
                'years' => range(2021, 1980),
            ])
            ->add('resumeFile', VichFileType::class, [
                'label' => 'CV',
                'required' => false,
                'download_uri' => false,
            ])
            ->add('coverLetterFile', VichFileType::class, [
                'label' => 'Lettre de motivation',
                'required' => false,
                'download_uri' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}
