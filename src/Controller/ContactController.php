<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

final class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $entityManager , MailerInterface $mailer): Response
    {
        $contact = new Contact();

        $form = $this->createForm(ContactFormType::class, $contact);

        $form->handleRequest($request);

        if($form -> isSubmitted() && $form -> isValid()) {
            //on sauvegarde en base de données
            $entityManager->persist($contact);
            $entityManager->flush();

            // on envoi l'email de notification à l'administrateur du site 
            $adminEmail = $this->getParameter('admin_email'); // vérifier qu'on a ce parametre dans services.ymal ou .env 
            
            $email =(new Email())
               ->from($contact->getEmail())
               ->to($adminEmail)
               ->subject('Nouveau message de contact :' . $contact->getSubject())
               ->html($this->renderView(
                    'emails/admin_notification.html.twig',
                    ['contact' => $contact]
               ));
            $mailer->send($email);

            $this->addFlash('Success', 'Votre message a bien été envoyé et sera traité dans les plus brefs délais.');
            return $this->redirectToRoute('app_contact');
            
            }

        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'form' => $form->createView(), 
        ]);
    }
}
