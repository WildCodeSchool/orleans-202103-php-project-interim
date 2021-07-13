<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contactFormData = $form->getData();
            // Ici nous enverrons l'e-mail
            $message = (new Email())
                //on attribue l'expéditeur
                ->from($contactFormData->getEmail())

                //on attribue le receveur
                ->to(strval($this->getParameter('mailer_to')))
                ->subject('Vous avez reçu un email')

                //On créé le message avec la vue twig
                ->html($this->renderView('email/newContactEmail.html.twig', ['contact' => $contact]));

                //on envoie le message
                $mailer->send($message);
            // Displaying a confirmation message to the user
            $this->addFlash(
                'success',
                'Votre message a été transmis, nous vous répondrons dans les meilleurs délais.'
            );

            return $this->redirectToRoute('contact');
        }
        return $this->render('contact/index.html.twig', ['form' => $form->createView(), 'contact' => $contact]);
    }
}
