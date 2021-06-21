<?php

namespace App\Controller;

use App\Entity\QuotationRequest;
use App\Entity\User;
use App\Entity\Job;
use App\Entity\Company;
use App\Form\QuotationRequestType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\JobRepository;

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
     * @Route("/offres", name="jobs")
     */
    public function list(): Response
    {
        if (!is_null($this->getUser())) {
            /** @phpstan-ignore-next-line */
            $jobs = $this->getUser()->getCompany()->getJobs();
        } else {
            $jobs = [];
        }

        return $this->render('company/list.html.twig', [
            'jobs' =>  $jobs,
        ]);
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
            //Displaying a confirmation message to the user
            $this->addFlash(
                'success',
                'Merci pour votre demande, nous reviendrons vers vous dans les meilleurs délais.'
            );
            // Sending an email to the admin

            return $this->redirectToRoute('company_quotation');
        }

        return $this->render('company/quotationRequest.html.twig', [
            "form" => $form->createView(),
            "quotationRequest" => $quotationRequest,
        ]);
    }
}
