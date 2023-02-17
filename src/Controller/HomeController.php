<?php

namespace App\Controller;

use App\Service\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class HomeController extends AbstractController
{
    public function __construct(

        private NewsRepository $newsRepository,
        private bool $isDebug
    )
    {

    }

    #[Route(path:'/', name: 'app_home')]
    public function home(): Response
    {
        $categories = $this->newsRepository->findAllCategories();

        $pageTitle = "Sistema de Notícias";
        return $this->render('home.html.twig', [
            'pageTitle' => $pageTitle,
            'categories' => $categories,
        ]);
    }


    #[Route(path:'/category/{slug}', name: 'app_category_list')]
    public function category($slug): Response
    {
        $categories = $this->newsRepository->findAllCategories();
        $news =  $this->newsRepository->findAll();
        $pageTitle = $slug;

        return $this->render('category.html.twig', [
            'pageTitle' => $pageTitle,
            'categories' => $categories,
            'news' => $news,
        ]);
    }

}
