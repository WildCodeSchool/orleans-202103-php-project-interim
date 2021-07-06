<?php

namespace App\Controller;

use DateTime;
use App\Entity\Job;
use App\Entity\User;
use App\Form\JobType;
use App\Entity\Company;
use App\Entity\QuotationRequest;
use App\Repository\JobRepository;
use Symfony\Component\Mime\Email;
use App\Form\QuotationRequestType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * @Route("/entreprise", name="company_")
 * @IsGranted("ROLE_COMPANY")
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

        return $this->render('company/list_jobs.html.twig', [
            'jobs' =>  $jobs,
        ]);
    }

    /**
     * @Route("/offres/ajouter", name="jobs_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $job = new Job();
        $form = $this->createForm(JobType::class, $job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $job->setRegisteredAt(new DateTime('now'));
            /** @phpstan-ignore-next-line */
            $job->setCompany($this->getUser()->getCompany());
            $entityManager->persist($job);
            $entityManager->flush();

            return $this->redirectToRoute('company_jobs');
        }

        return $this->render('job/new.html.twig', [
            'job' => $job,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/offres/modifier/{id}", name="jobs_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Job $job): Response
    {
        /** @var User */
        $user = $this->getUser();
        /** @var Company */
        $company = $user->getCompany();

        if (!$user->$company->getJobs()->contains($job)) {
            throw new AccessDeniedException('Vous n\'êtes pas autorisé à accéder à cette page');
        }

        $form = $this->createForm(JobType::class, $job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('company_jobs');
        }

        return $this->render('job/edit.html.twig', [
            'job' => $job,
            'form' => $form->createView(),
        ]);
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

    /**
     * @Route("/profil", name="profile")
     */
    public function profile(): Response
    {
        /** @var User */
        $user = $this->getUser();
        $company = $user->getCompany();

        return $this->render('company/profile.html.twig', [
            "user" => $user,
            "company" => $company,
        ]);
    }
}
