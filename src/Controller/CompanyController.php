<?php

namespace App\Controller;

use App\Entity\QuotationRequest;
use App\Form\QuotationRequestType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

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
    public function quotationRequest(Request $request): Response
    {
        $quotationRequest = new QuotationRequest();
        $form = $this->createForm(QuotationRequestType::class, $quotationRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Message de confirmation pour l'utilisateur
            $this->addFlash(
                'message',
                'Merci pour votre demande, nous reviendrons vers vous dans les meilleurs délais.'
            );
            // Envoyer un mail

            return $this->redirectToRoute('company_quotation');
        }

        return $this->render('company/quotationRequest.html.twig', [
            "form" => $form->createView(),
            "quotationRequest" => $quotationRequest,
        ]);
    }
}
