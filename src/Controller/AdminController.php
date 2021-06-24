<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Company;
use App\Form\SearchType;
use App\Repository\CompanyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function companiesList(CompanyRepository $repository, Request $request): Response
    {
        $data = new SearchData();
        $form = $this->createForm(SearchType::class, $data);
        $form->handleRequest($request);
        $companies = $repository->findsearch($data);

        return $this->render(
            'admin/companiesList.html.twig',
            ['companies' => $companies, 'form' => $form->createView()]
        );
    }
}
