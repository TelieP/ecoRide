<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchCovoiturageFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lieu_depart', TextType::class,[
                'required' => false,
                'label' => 'Ville de départ',
                'attr' =>['placeholder' => 'Ex: Fotouni']
            ])

            ->add('lieu_arrivee', TextType::class, [
                'required' => false,
                'label' => 'Ville d\arrivée',
                'attr' => ['placeholder' => 'Ex: Bafang']
            ])
            ->add('date_depart', DateType::class, [
                'required'=> false,
                'label' => 'Date',
                'widget' => 'single_text',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
           'csrf_protection' => false,
            'method' => 'GET',
        ]);
    }
}
