<?php

namespace App\Form;

use App\Entity\Company;
use App\Form\UserEditType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user', UserEditType::class, [
                'label' => ''
            ])
            ->add('companyName', TextType::class, [
                'label' => ' Nom de la société'
            ])
            ->add('socialReason', TextType::class, [
                'label' => 'Raison sociale',
            ])
            ->add('siret', TextType::class, [
                'label' => 'Siret',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Company::class,
        ]);
    }
}
