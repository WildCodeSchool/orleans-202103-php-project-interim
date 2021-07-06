<?php

namespace App\Controller;

use App\Entity\FilterStudyField;
use App\Repository\JobRepository;
use App\Form\FilterStudyFieldType;
use Knp\Component\Pager\PaginatorInterface;
use PDO;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OfferController extends AbstractController
{
    /**
     * @Route("/offre", name="offer")
     */
    public function index(JobRepository $jobRepository, Request $request, PaginatorInterface $paginator): Response
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
        $jobs = $paginator->paginate(
            $jobs, /* query NOT result */
            $request->query->getInt('page', 1),
            9
        );
        return $this->render('offer/index.html.twig', [
            'jobs' => $jobs,
            'form' => $form->createView(),
        ]);
    }
}
