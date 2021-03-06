<?php

namespace App\Form;

use App\Entity\Student;
use App\Entity\StudyField;
use App\Form\FilterStudyFieldType;
use Symfony\Component\Form\AbstractType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user', UserEditType::class, [
                'label' => ''
            ])
            ->add('birthdate', BirthdayType::class, [
                'label' => 'Date de naissance',
                'years' => range(2021, 1980),
            ])
            ->add('studyField', EntityType::class, [
                'class' => StudyField::class,
                'choice_label' => 'studyFieldName',
                'label' => 'Domaine',
                'multiple' => false,
                'expanded' => false,
            ])
            ->add('level', ChoiceType::class, [
                'label' => ' Niveau d\'étude',
                'choices' => [
                    'Bac + 2' => 'Bac + 2',
                    'Bac + 3' => 'Bac + 3',
                    'Bac + 4' => 'Bac + 4',
                    'Bac + 5' => 'Bac + 5',
                    'Bac + 6' => 'Bac + 6',
                    'Bac + 7' => 'Bac + 7',
                    'Bac + 8' => 'Bac + 8',
                ],
            ])
            ->add('resumeFile', VichFileType::class, [
                'label' => 'CV (format .pdf)',
                'required' => false,
                'download_uri' => false,
            ])
            ->add('coverLetterFile', VichFileType::class, [
                'label' => 'Lettre de motivation (format .pdf)',
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
