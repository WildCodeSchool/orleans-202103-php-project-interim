<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Company;
use App\Entity\FilterStudyField;
use App\Form\FilterStudyFieldType;
use App\Repository\StudentRepository;
use App\Form\SearchType;
use App\Repository\CompanyRepository;
use App\Entity\Student;
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
     * @Route("/entreprises/{id}", name="delete_company", methods={"POST"})
     */
    public function deleteCompany(Request $request, Company $company): Response
    {
        if ($this->isCsrfTokenValid('deleteCompany' . $company->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($company);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_companies');
    }

    /**
     * @Route("/entreprises", name="companies")
     */
    public function companiesList(CompanyRepository $repository, Request $request): Response
    {
        $data = new SearchData();
        $form = $this->createForm(SearchType::class, $data);
        $form->handleRequest($request);
        $companies = $repository->findSearch($data);

        return $this->render(
            'admin/companies_list.html.twig',
            ['companies' => $companies, 'form' => $form->createView()]
        );
    }

    /**
     * @Route("/etudiants/{id}", name="delete_student", methods={"POST"})
     */
    public function deleteStudent(Request $request, Student $student): Response
    {
        if ($this->isCsrfTokenValid('deleteStudent' . $student->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($student);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_students');
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
