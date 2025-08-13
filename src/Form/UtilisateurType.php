<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Role;
use App\Form\RoleType;

class UtilisateurType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('nom')
      ->add('prenom')
      ->add('email')
      ->add('password')
      ->add('telephone')
      ->add('adresse')
      ->add('date_naissance')
      ->add('photo')
      ->add('pseudo');
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => Utilisateur::class,
    ]);
  }
}