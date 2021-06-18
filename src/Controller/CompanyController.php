<?php

namespace App\Controller;

use App\Entity\QuotationRequest;
use Symfony\Component\Mime\Email;
use App\Form\QuotationRequestType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/entreprise", name="company_")
 */
class CompanyController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('company/index.html.twig');
    }
    /**
     * @Route("/devis", name="quotation")
     */
    public function quotationRequest(Request $request, MailerInterface $mailer): Response
    {
        $quotationRequest = new QuotationRequest();
        $form = $this->createForm(QuotationRequestType::class, $quotationRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Displaying a confirmation message to the user
            $this->addFlash(
                'success',
                'Merci pour votre demande, nous reviendrons vers vous dans les meilleurs délais.'
            );
            // Sending an email to the admin
            $email = (new Email())
                ->from((string)$quotationRequest->getEmail())
                ->to(strval($this->getParameter('mailer_to')))
                ->subject('Une nouvelle demande de devis vient d\'être envoyée !')
                ->html($this->renderView(
                    'email/quotationRequestEmail.html.twig',
                    ['quotationRequest' => $quotationRequest]
                ));

            $mailer->send($email);

            return $this->redirectToRoute('company_quotation');
        }

        return $this->render('company/quotationRequest.html.twig', [
            "form" => $form->createView(),
            "quotationRequest" => $quotationRequest,
        ]);
    }
}
