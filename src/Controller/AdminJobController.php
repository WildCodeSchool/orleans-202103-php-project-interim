<?php

namespace App\Controller;

use App\Entity\Job;
use App\Form\AdminJobType;
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
