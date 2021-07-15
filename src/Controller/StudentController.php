<?php

namespace App\Controller;

use App\Entity\Job;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Entity\Student;
use App\Form\StudentType;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/etudiant", name="student_")
 * @IsGranted("ROLE_STUDENT")
 */
class StudentController extends AbstractController
{
    /**
     * @Route("/profil", name="profile")
     */
    public function profile(): Response
    {
        /** @var User */
        $user = $this->getUser();

        return $this->render('student/profile.html.twig', [
            "user" => $user,
        ]);
    }
    /**
     * @Route("/profil/modifier", name="edit", methods={"GET","POST"})
     */
    public function studentEdit(Request $request): Response
    {
        /** @var User */
        $user = $this->getUser();
        $student = $user->getStudent();
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            // give mesage if success
            $this->addFlash('success', 'Votre profil a été modifié.');

            return $this->redirectToRoute('student_profile');
        }
        return $this->render('student/edit.html.twig', [
            'student' => $student,
            'studentForm' => $form->createView(),
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

        // Sending an email to the student
        $email = (new Email())
        ->from(strval($this->getParameter('mailer_from')))
        ->to(strval($user->getEmail()))
        ->subject('Votre candidature au poste de ' . $job->getPost())
        ->html($this->renderView('email/confirmedApplicationEmail.html.twig', [
            'user' => $user,
            'job' => $job,
        ]));

        $mailer->send($email);

        // Displaying a confirmation message to the user
        $this->addFlash(
            'success',
            'Nous prenons en compte votre demande, nous vous répondrons dans les meilleurs délais.'
        );

        return $this->redirectToRoute('offer');
    }
}
