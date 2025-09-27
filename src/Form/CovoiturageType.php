<?php

namespace App\Form;

use App\Entity\Covoiturage;
use App\Entity\Utilisateur;
use App\Entity\Voiture;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CovoiturageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_depart')
            ->add('heure_depart')
            ->add('lieu_depart')
            ->add('date_arrivee')
            ->add('heure_arrivee')
            ->add('lieu_arrivee')
            ->add('statut')
            ->add('nb_place')
            ->add('prix_personne')
            ->add('participants', EntityType::class, [
                'class' => Utilisateur::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('user_id')
            ->add('voiture', EntityType::class, [
                'class' => Voiture::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Covoiturage::class,
        ]);
    }
}
