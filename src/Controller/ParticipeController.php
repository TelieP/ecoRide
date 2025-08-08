<?php

namespace App\Controller;

use App\Entity\Participe;
use App\Form\ParticipeType;
use App\Repository\ParticipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/participe')]
final class ParticipeController extends AbstractController
{
  #[Route(name: 'app_participe_index', methods: ['GET'])]
  public function index(ParticipeRepository $participeRepository): Response
  {
    return $this->render('participe/index.html.twig', [
      'participes' => $participeRepository->findAll(),
    ]);
  }

  #[Route('/new', name: 'app_participe_new', methods: ['GET', 'POST'])]
  public function new(
    Request $request,
    EntityManagerInterface $entityManager,
  ): Response {
    $participe = new Participe();
    $form = $this->createForm(ParticipeType::class, $participe);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $entityManager->persist($participe);
      $entityManager->flush();

      return $this->redirectToRoute(
        'app_participe_index',
        [],
        Response::HTTP_SEE_OTHER,
      );
    }

    return $this->render('participe/new.html.twig', [
      'participe' => $participe,
      'form' => $form,
    ]);
  }

  #[Route('/{id}', name: 'app_participe_show', methods: ['GET'])]
  public function show(Participe $participe): Response
  {
    return $this->render('participe/show.html.twig', [
      'participe' => $participe,
    ]);
  }

  #[Route('/{id}/edit', name: 'app_participe_edit', methods: ['GET', 'POST'])]
  public function edit(
    Request $request,
    Participe $participe,
    EntityManagerInterface $entityManager,
  ): Response {
    $form = $this->createForm(ParticipeType::class, $participe);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $entityManager->flush();

      return $this->redirectToRoute(
        'app_participe_index',
        [],
        Response::HTTP_SEE_OTHER,
      );
    }

    return $this->render('participe/edit.html.twig', [
      'participe' => $participe,
      'form' => $form,
    ]);
  }

  #[Route('/{id}', name: 'app_participe_delete', methods: ['POST'])]
  public function delete(
    Request $request,
    Participe $participe,
    EntityManagerInterface $entityManager,
  ): Response {
    if (
      $this->isCsrfTokenValid(
        'delete' . $participe->getId(),
        $request->getPayload()->getString('_token'),
      )
    ) {
      $entityManager->remove($participe);
      $entityManager->flush();
    }

    return $this->redirectToRoute(
      'app_participe_index',
      [],
      Response::HTTP_SEE_OTHER,
    );
  }
}
