<?php

namespace App\Controller;

use App\Entity\Job;
use App\Repository\JobRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JobController extends AbstractController
{
    /**
     * @Route("/offres/{id}", name="offer_show")
     */
    public function show(int $id): Response
    {
        $job = $this->getDoctrine()
            ->getRepository(Job::class)
            ->find($id);

        if (!$job) {
            throw $this->createNotFoundException(
                'Aucune offre d\'emploi correspondante à l\'identifiant ' . $id
            );
        }
        return $this->render('job/show.html.twig', [
            'job' => $job,
        ]);
    }
}
