<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\CovoiturageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

final class UtilisateurController extends AbstractController
{
    #[Route('/utilisateur', name: 'app_utilisateur')]
    public function index(): Response
    {
        return $this->render('utilisateur/index.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }
     #[Route('/profil', name: 'app_user_profile')]
    #[IsGranted('ROLE_USER')]
    public function profile(CovoiturageRepository $covoiturageRepository): Response
    {
        $user = $this->getUser();

        // Récupérer les trajets proposés par l'utilisateur
        $trajetsProposes = $covoiturageRepository->findBy(['user' => $user]);

        return $this->render('user/profile.html.twig', [
            'user' => $user,
            'trajets_proposes' => $trajetsProposes,
            // 'trajets_reserves' => $trajetsReserves, // Décommenter si vous avez cette relation
        ]);
    }
}
