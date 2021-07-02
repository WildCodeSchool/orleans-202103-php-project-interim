<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\FilterStudyField;
use App\Form\FilterStudyFieldType;
use App\Repository\StudentRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin", name="admin_")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }
    /**
     * @Route("/entreprises", name="companies")
     */
    public function companiesList(): Response
    {
        $companies = $this->getDoctrine()
            ->getRepository(Company::class)
            ->findAll();

        return $this->render(
            'admin/companies_list.html.twig',
            ['companies' => $companies]
        );
    }
    /**
     * @Route("/etudiants", name="students")
     */
    public function studentsList(StudentRepository $studentRepository, Request $request): Response
    {
        $filter = new FilterStudyField();
        $form = $this->createForm(FilterStudyFieldType::class, $filter);
        $form->handleRequest($request);
        $students = $studentRepository->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $students = $studentRepository->findBy([
                'studyField' => $filter->getStudyField()
            ]);
        }

        return $this->render(
            'admin/students_list.html.twig',
            ['students' => $students, 'form' => $form->createView()]
        );
    }
}
