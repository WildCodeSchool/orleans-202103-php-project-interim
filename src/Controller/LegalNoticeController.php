<?php

namespace App\Controller;

use App\Entity\LegalNotice;
use App\Form\LegalNoticeType;
use App\Repository\LegalNoticeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mentions/legales",name="legal_notice_")
 */
class LegalNoticeController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(LegalNoticeRepository $repository): Response
    {
        return $this->render('legal_notice/index.html.twig', [
            'legal_notices' => $repository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $legalNotice = new LegalNotice();
        $form = $this->createForm(LegalNoticeType::class, $legalNotice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($legalNotice);
            $entityManager->flush();

            return $this->redirectToRoute('legal_notice_index');
        }

        return $this->render('legal_notice/new.html.twig', [
            'legal_notice' => $legalNotice,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{id}/edit", name="edit", methods={"GET","POST"})
     */
    public function edit(Request $request, LegalNotice $legalNotice): Response
    {
        $form = $this->createForm(LegalNoticeType::class, $legalNotice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('legal_notice_index');
        }

        return $this->render('legal_notice/edit.html.twig', [
            'legal_notice' => $legalNotice,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"POST"})
     */
    public function delete(Request $request, LegalNotice $legalNotice): Response
    {
        if ($this->isCsrfTokenValid('delete' . $legalNotice->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($legalNotice);
            $entityManager->flush();
        }

        return $this->redirectToRoute('legal_notice_index');
    }
}
