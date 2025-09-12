<?php

namespace App\Controller\Admin;

use App\Entity\Covoiturage;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CovoiturageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Covoiturage::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
            TextEditorField::new('lieu_depart','Lieu de Départ'),
            DateTimeField::new('date_depart','Date de Départ'),
            TextEditorField::new('lieu_arrivee','Lieu d\'arrivée'),
            DateTimeField::new('heure_depart', 'Heure de départ'),
            TextField::new('nb_place','Nombre de places'),
            TextField::new('prix_personne','Prix par personne'),

        ];
    }
    
}
