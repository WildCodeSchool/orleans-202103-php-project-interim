<?php

namespace App\Controller;

use App\Repository\JobRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(JobRepository $jobRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'jobs' => $jobRepository->findBy(
                [],
                ['id' => 'DESC'],
                3
            )
        ]);
    }
}
