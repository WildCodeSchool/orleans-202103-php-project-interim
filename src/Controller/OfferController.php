<?php

namespace App\Controller;

use App\Repository\JobRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OfferController extends AbstractController
{
    /**
     * @Route("/offer", name="offer")
     */
    public function index(JobRepository $jobRepository): Response
    {
        return $this->render('offer/index.html.twig', [
            'jobs' => $jobRepository->findAll(),
        ]);
    }
}
