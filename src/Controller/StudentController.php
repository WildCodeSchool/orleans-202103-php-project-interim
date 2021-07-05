<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Student;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class StudentController extends AbstractController
{
    /**
     * @Route("/etudiant/", name="student_home")
     * @IsGranted("ROLE_STUDENT")
     */
    public function index(): Response
    {
        return $this->render('student/index.html.twig');
    }
    /**
    * @Route("/etudiant/profil", name="student_profile")
    */
    public function profile(): Response
    {
        /** @var User */
        $user = $this->getUser();
        $student = $user->getStudent();

        return $this->render('student/profile.html.twig', [
            "user" => $user,
            "student" => $student,
        ]);
    }
}
