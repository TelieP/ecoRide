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
            $entityManager->persist($covoiturage);
            $entityManager->flush();

            return $this->redirectToRoute('app_covoiturage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('covoiturage/new.html.twig', [
            'covoiturage' => $covoiturage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_covoiturage_show', methods: ['GET'])]
    public function show(Covoiturage $covoiturage): Response
    {
        return $this->render('covoiturage/show.html.twig', [
            'covoiturage' => $covoiturage,
        ]);
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
        $repoFielteredCovoits = $covoitRepository->findFilteredCovoits(
            $depart,
            $arrivee,
            $date,
        );
        $filteredCovoits = [];
        foreach ($repoFielteredCovoits as $filteredCovoit) {
            array_push($filteredCovoits, $filteredCovoit['id']);
        }

        // Get all covoits ids
        $allCovoitIds = [];
        foreach ($covoitRepository->findAll() as $covoit) {
            array_push($allCovoitIds, $covoit->getId());
        }

        return $this->json([
            'allCovoitIds' => $allCovoitIds,
            'filteredCovoits' => $filteredCovoits
        ]);
    }
}
