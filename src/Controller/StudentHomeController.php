<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentHomeController extends AbstractController
{
    /**
     * @Route("/student/", name="student_home")
     */
    public function index(): Response
    {
        return $this->render('student/index.html.twig');
    }
}
