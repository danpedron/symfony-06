<?php

namespace App\Controller;

use App\Entity\News;
use App\Repository\NewsCategoryRepository;
use App\Repository\NewsRepository;
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
    public function home(NewsCategoryRepository $categoryRepository): Response
    {

        $categories = $categoryRepository->findAll();

        $pageTitle = "Sistema de Notícias";
        return $this->render('home.html.twig', [
            'pageTitle' => $pageTitle,
            'categories' => $categories,
        ]);
    }


    #[Route(path:'/category/{slug}', name: 'app_category_list')]
    public function category($slug,NewsRepository $newsRepository, NewsCategoryRepository $categoryRepository): Response
    {

        //$news = $newsRepository->findAll();
        $news = $newsRepository->findByCategoryTitle($slug);

        $categories = $categoryRepository->findAll();

        $pageTitle = $slug;

        return $this->render('category.html.twig', [
            'pageTitle' => $pageTitle,
            'categories' => $categories,
            'news' => $news,
        ]);
    }

}
