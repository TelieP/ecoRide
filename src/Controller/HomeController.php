<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\CovoiturageRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
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

        
        $trajetsProposes = $covoiturageRepository->findBy(['user' => $user]);

        return $this->render('user/profile.html.twig', [
            'user' => $user,
            'trajets_proposes' => $trajetsProposes,
        ]);
    }
}
