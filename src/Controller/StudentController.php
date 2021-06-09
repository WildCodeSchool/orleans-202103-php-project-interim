<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    /**
     * @Route("/etudiant/", name="student_home")
     */
    public function index(): Response
    {
        return $this->render('student/index.html.twig');
    }
}
