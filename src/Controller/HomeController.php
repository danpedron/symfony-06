<?php

namespace App\Controller;

use App\Service\NewsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HomeController extends AbstractController
{

    #[Route(path:'/', name: 'app_home')]
    public function home(NewsService $service): Response
    {

        $pageTitle = "Sistema de Notícias";
        return $this->render('home.html.twig', [
            'pageTitle' => $pageTitle,
            'categories' => $service->getCategoyList(),
        ]);
    }

    #[Route(path:'/category/{slug}', name: 'app_category_list')]
    public function category($slug, NewsService $service): Response
    {
        $pageTitle = $slug;
        return $this->render('category.html.twig', [
            'pageTitle' => $pageTitle,
            'categories' => $service->getCategoyList(),
            'news' => $service->getNewsList(),
        ]);
    }

}