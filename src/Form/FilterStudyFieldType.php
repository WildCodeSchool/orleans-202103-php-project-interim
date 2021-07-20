<?php

namespace App\Form;

use App\Entity\FilterStudyField;
use App\Entity\StudyField;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterStudyFieldType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('studyField', EntityType::class, [
                'class' => StudyField::class,
                'choice_label' => 'studyFieldName',
                'label' => 'Domaine d\'étude',
                'required' => false,
                'placeholder' => 'Tout afficher',
                'multiple' => false,
                'expanded' => false,
                'attr' => [
                    'aria-label' => 'Domaines d\'etudes'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FilterStudyField::class,
        ]);
    }
}
