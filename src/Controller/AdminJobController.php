<?php

namespace App\Controller;

use App\Entity\Job;
use App\Form\AdminJobType;
use App\Entity\FilterStudyField;
use App\Repository\JobRepository;
use Knp\Component\Pager\PaginatorInterface;
use App\Form\FilterStudyFieldType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/offres", name="admin_job_")
 */
class AdminJobController extends AbstractController
{
    /**
     * @Route("/", name="index")
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
        return $this->render('admin_job/index.html.twig', [
            'jobs' => $jobs,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{id}/edit", name="edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Job $job): Response
    {
        $form = $this->createForm(AdminJobType::class, $job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_job_index');
        }

        return $this->render('admin_job/edit.html.twig', [
            'job' => $job,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"POST"})
     */
    public function delete(Request $request, Job $job): Response
    {
        if ($this->isCsrfTokenValid('delete' . $job->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($job);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_job_index');
    }
}
