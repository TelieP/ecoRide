<?php

namespace App\Form;

use App\Entity\Covoiturage;
use App\Entity\Participe;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParticipeType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('utilisateur', EntityType::class, [
        'class' => Utilisateur::class,
        'choice_label' => 'nom',
      ])
      ->add('covoiturage', EntityType::class, [
        'class' => Covoiturage::class,
        'choice_label' => 'id',
      ]);
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => Participe::class,
    ]);
  }
}
