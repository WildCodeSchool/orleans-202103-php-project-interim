<?php

namespace App\Controller;

use App\Entity\FilterStudyField;
use App\Repository\JobRepository;
use App\Form\FilterStudyFieldType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OfferController extends AbstractController
{
    /**
     * @Route("/offre", name="offer")
     */
    public function index(JobRepository $jobRepository, Request $request): Response
    {
        $filter = new FilterStudyField();
        $form = $this->createForm(FilterStudyFieldType::class, $filter);
        $form->handleRequest($request);
        $jobs = $jobRepository->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $jobs = $jobRepository->findBy([
                'studyField' => $filter->getStudyField()
            ]);
        }

        return $this->render('offer/index.html.twig', [
            'jobs' => $jobs,
            'form' => $form->createView(),
        ]);
    }
}
