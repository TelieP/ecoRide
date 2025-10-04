<?php

namespace App\Controller;

use App\Entity\Covoiturage;
use App\Form\CovoiturageType;
use App\Repository\CovoiturageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('/covoiturage')]
final class CovoiturageController extends AbstractController
{
    #[Route(name: 'app_covoiturage_index', methods: ['GET'])]
    public function index(Request $request , CovoiturageRepository $covoiturageRepository): Response
    {
        $covoiturages = $covoiturageRepository->findAll();
        return $this->render('covoiturage/index.html.twig', [
            'covoiturages' => $covoiturages,
        ]);
    }

    #[Route('/new', name: 'app_covoiturage_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $covoiturage = new Covoiturage();
        $form = $this->createForm(CovoiturageType::class, $covoiturage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $this->getUser();
            $covoiturage->setUser($user); 

            $entityManager->persist($covoiturage);
            $entityManager->flush();

            return $this->redirectToRoute('app_covoiturage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('covoiturage/new.html.twig', [
            'covoiturage' => $covoiturage,
            'form' => $form,
        ]);
    }

    /**
     * Gets the filtered cars
     *
     * @param Request $request The current request
     * @param CovoiturageRepository $covoiturageRepository The Covoiturage Repository
     * @return JsonResponse An array with all covoits ids and filtered covoits ids
     */
   
    #[Route('/getCovoitRecherches', name: 'getCovoitRecherches', methods: ['GET'])]
    public function getCovoitRecherches(Request $request, CovoiturageRepository $covoitRepository): JsonResponse
    {
        // Get filter information
        $depart = $request->query->get('depart');
        $arrivee = $request->query->get('arrivee');
        $date = $request->query->get('date');
        

        // Get filtered car covoits
        // J'ai renommé $covoiturageRepository en $covoitRepository dans la signature
        $repoFielteredCovoits = $covoitRepository->findFilteredCovoits(
            $depart,
            $arrivee,
            $date,
        );
        $filteredCovoits = [];
        foreach ($repoFielteredCovoits as $filteredCovoit) {
            array_push($filteredCovoits, $filteredCovoit);
        }

        return $this->json($filteredCovoits);
    }


    #[Route('/{id}', name: 'app_covoiturage_show', methods: ['GET'])]
    public function show(Covoiturage $covoiturage): Response
    {
        return $this->render('covoiturage/show.html.twig', [
            'covoiturage' => $covoiturage,
        ]);
    }

    // reservation d'un trajet de covoit 

#[Route('/covoiturage/{id}/reserver', name: 'app_covoiturage_reserver', methods: ['POST'])]
public function reserver(Covoiturage $covoiturage, EntityManagerInterface $entityManager): Response
{
    // 1. Vérification de l'authentification (Sécurité)
    if (!$this->getUser()) {
        $this->addFlash('error', 'Vous devez être connecté pour réserver un trajet.');
        return $this->redirectToRoute('app_login'); // Rediriger vers la connexion
    }
    
    $user = $this->getUser();

    // 2. Vérification de la disponibilité des places
    $placesDisponibles = $covoiturage->getNbPlace();
    
    if ($placesDisponibles <= 0) {
        $this->addFlash('error', 'Désolé, il n\'y a plus de places disponibles pour ce trajet.');
        return $this->redirectToRoute('app_covoiturage_index'); 
    }

    // 3. Vérification que l'utilisateur n'a pas déjà réservé
    if ($covoiturage->getParticipants()->contains($user)) {
        $this->addFlash('error', 'Vous avez déjà réservé une place pour ce trajet.');
        return $this->redirectToRoute('app_covoiturage_index');
    }

    // 4. Mettre à jour l'entité
    // A. Ajouter l'utilisateur à la collection de participants
    $covoiturage->addParticipant($user);

    // B. Décrémenter le nombre de places disponibles
    $covoiturage->setNbPlace($placesDisponibles - 1);

    // 5. Sauvegarder en base de données
    $entityManager->flush();

    $this->addFlash('success', 'Réservation effectuée avec succès ! Une place a été déduite.');

    return $this->redirectToRoute('app_covoiturage_index'); 
} 


    #[Route('/{id}/edit', name: 'app_covoiturage_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Covoiturage $covoiturage, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CovoiturageType::class, $covoiturage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_covoiturage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('covoiturage/edit.html.twig', [
            'covoiturage' => $covoiturage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_covoiturage_delete', methods: ['POST'])]
    public function delete(Request $request, Covoiturage $covoiturage, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$covoiturage->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($covoiturage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_covoiturage_index', [], Response::HTTP_SEE_OTHER);
    }
}
