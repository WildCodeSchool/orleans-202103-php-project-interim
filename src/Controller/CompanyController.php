<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompanyController extends AbstractController
{
    /**
     * @Route("/entreprise/", name="company_home")
     */
    public function index(): Response
    {
        return $this->render('company/index.html.twig');
    }
}
