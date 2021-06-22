<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\Student;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
    public function studentsList(): Response
    {
        $students = $this->getDoctrine()
            ->getRepository(Student::class)
            ->findAll();

        return $this->render(
            'admin/students_list.html.twig',
            ['students' => $students]
        );
    }
}
