<?php

namespace App\Controller\Admin;

use App\Entity\Utilisateur;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UtilisateurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Utilisateur::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('nom','Nom'),
            TextField::new('prenom','Prénom'),
            TextField::new('telephone', 'Téléphone'),
            TextField::new('role','Role'),
            TextField::new('email','Email'),
            // AssociationField::new('covoiturage','Covoiturage'),
            // AssociationField::new('avis','Avis'),
            // AssociationField::new('voiture', 'Voiture'),


            TextEditorField::new('description'),
        ];
    }

}
