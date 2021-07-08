<?php

namespace App\Controller;

use App\Entity\Job;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Entity\Student;
use App\Form\StudentEditType;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
     * @Route("/{id}/edit", name="student_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Student $student): Response
    {
        $form = $this->createForm(StudentEditType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            // give mesage if success
            $this->addFlash('success', 'Votre profil a été modifié.');

            return $this->redirectToRoute('student_index');
        }

        return $this->render('student_edit.html.twig', [
            'student' => $student,
            'form' => $form->createView(),
        ]);
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
    /**
     * @Route("/postulate/{job}", name="postulate")
     * @IsGranted("ROLE_STUDENT")
     */
    public function postulate(Request $request, MailerInterface $mailer, Job $job): Response
    {
        /** @var User */
        $user = $this->getUser();
        // Ici nous enverrons l'e-mail
        $message = (new Email())
            //on attribue l'expéditeur
            ->from(strval($user->getEmail()))
            //on attribue le receveur
            ->to(strval($this->getParameter('mailer_to')))
            ->subject('Un étudiant a confirmé vouloir postuler à une annonce')
            //On créé le message avec la vue twig
            ->html($this->renderView('email/postulateEmail.html.twig', [
                'user' => $user,
                'job' => $job,
            ]));
        //on envoie le message
        $mailer->send($message);
        // give mesage if success
        $this->addFlash('success', 'Nous prenons en compte votre demande, 
        nous vous répondrons dans les meilleurs délais.');
        return $this->redirectToRoute('offer');
    }
}
