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
    // #[Route('/profil', name: 'app_utilisateur_profile')]
    // public function profile(CovoiturageRepository $covoiturageRepository): Response
    // {
    //     // Récupérer l'utilisateur connecté
    //     $user = $this->getUser();

    //     // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
    //     if (!$user) {
    //         return $this->redirectToRoute('app_login');
    //     }

    //     // Récupérer les trajets proposés par l'utilisateur
    //     $trajetsProposes = $covoiturageRepository->findBy(['user' => $user]);

    //     // Vous devez aussi récupérer les trajets réservés. Cela dépend de votre entité.
    //     // Si vous avez une relation ManyToMany ou une entité de jointure
    //     // (par exemple, 'Reservation'), vous devez l'utiliser.
    //     // Exemple (si l'utilisateur a une collection de réservations) :
    //     $trajetsReserves = $user->getReservations()->map(function($reservation) {
    //         return $reservation->getCovoiturage();
    //     });

    //     return $this->render('user/profile.html.twig', [
    //         'user' => $user,
    //         'trajets_proposes' => $trajetsProposes,
    //         'trajets_reserves' => $trajetsReserves,
    //     ]);
    // }
}
