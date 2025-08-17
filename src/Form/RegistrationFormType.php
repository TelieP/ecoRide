<?php

namespace App\Form;

use App\Entity\Covoiturage;
use App\Entity\Utilisateur;
use App\Entity\Voiture;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('roles')
            ->add('password')
            ->add('nom')
            ->add('prenom')
            ->add('telephone')
            ->add('adresse')
            ->add('date_naissance')
            ->add('photo')
            ->add('pseudo')
            ->add('voitures', EntityType::class, [
                'class' => Voiture::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('participations', EntityType::class, [
                'class' => Covoiturage::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
