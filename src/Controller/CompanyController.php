<?php

namespace App\Controller;

use DateTime;
use App\Entity\Job;
use App\Entity\User;
use App\Form\CompanyType;
use App\Form\JobType;
use App\Entity\Company;
use App\Entity\QuotationRequest;
use App\Repository\JobRepository;
use Symfony\Component\Mime\Email;
use App\Form\QuotationRequestType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * @Route("/entreprise", name="company_")
 */
class CompanyController extends AbstractController
{
    /**
     * @Route("/profil/modifier", name="edit", methods={"GET","POST"})
     * @IsGranted("ROLE_COMPANY")
     */
    public function companyEdit(Request $request): Response
    {
        /** @var User */
        $user = $this->getUser();
        $company = $user->getCompany();
        $form = $this->createForm(CompanyType::class, $company);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            // give mesage if success
            $this->addFlash('success', 'Votre profil a été modifié.');

            return $this->redirectToRoute('company_profile');
        }
        return $this->render('company/_form.html.twig', [
            'company' => $company,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/offres", name="jobs")
     * @IsGranted("ROLE_COMPANY")
     */
    public function list(PaginatorInterface $paginator, Request $request): Response
    {
        if (!is_null($this->getUser())) {
            /** @phpstan-ignore-next-line */
            $jobs = $this->getUser()->getCompany()->getJobs();
        } else {
            $jobs = [];
        }
        $jobs = $paginator->paginate(
            $jobs, /* query NOT result */
            $request->query->getInt('page', 1),
            9
        );
        return $this->render('company/list_jobs.html.twig', [
            'jobs' =>  $jobs,
        ]);
    }

    /**
     * @Route("/offres/ajouter", name="jobs_new", methods={"GET","POST"})
     * @IsGranted("ROLE_COMPANY")
     */
    public function new(Request $request): Response
    {
        /** @var User */
        $user = $this->getUser();
        /** @var Company */
        $company = $user->getCompany();
        if ($company->getSocialReason() == null && $company->getSiret() == null && $company->getCompanyName() == null) {
            $this->addFlash(
                'warning',
                'Veuillez remplir vos informations avant de pouvoir ajouter une annonce.'
            );
            return $this->redirectToRoute('company_profile');
        }
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
     * @IsGranted("ROLE_COMPANY")
     */
    public function edit(Request $request, Job $job): Response
    {
        /** @var User */
        $user = $this->getUser();
        /** @var Company */
        $company = $user->getCompany();

        if ($company->getSocialReason() == null && $company->getSiret() == null && $company->getCompanyName() == null) {
            $this->addFlash(
                'warning',
                'Veuillez remplir vos informations avant de pouvoir modifier une annonce.'
            );
            return $this->redirectToRoute('company_profile');
        }

        if (!$company->getJobs()->contains($job)) {
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
     * @Security("is_granted('ROLE_COMPANY') or is_granted('ROLE_ADMIN')")
     */
    public function quotationRequest(Request $request, MailerInterface $mailer): Response
    {
        $quotationRequest = new QuotationRequest();
        /**
         * @var User
         */
        $user = $this->getUser();
        /**
         * @var Company
         */
        $company = $user->getCompany();
        $quotationRequest->setCompanyName((string)$company->getCompanyName());
        $quotationRequest->setEmail((string)$user->getEmail());
        $quotationRequest->setContactName($user->getFirstname() . ' ' . $user->getLastname());
        $quotationRequest->setPhone((string)$user->getPhone());
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
     * @IsGranted("ROLE_COMPANY")
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
