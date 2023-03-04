<?php

namespace App\Controller;

use App\Service\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReportController extends AbstractController
{
    #[Route('/report', name: 'app_report')]
    public function index(NewsRepository $newsRepository): Response
    {
        return $this->render('report/index.html.twig', [
             'categories' => $newsRepository->findAllCategories(),
            'controller_name' => 'ReportController',
        ]);
    }
}
