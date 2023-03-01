<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HomeController extends AbstractController
{

    #[Route(path:'/', name: 'app_home')]
    public function home(HttpClientInterface $httpClient): Response
    {

        $pageTitle = "Sistema de Notícias";
        return $this->render('home.html.twig', [
            'pageTitle' => $pageTitle,
            'categories' => $this->getCategoyList($httpClient),
        ]);
    }

    #[Route(path:'/category/{slug}', name: 'app_category_list')]
    public function category($slug, HttpClientInterface $httpClient): Response
    {
        $pageTitle = $slug;
        return $this->render('category.html.twig', [
            'pageTitle' => $pageTitle,
            'categories' => $this->getCategoyList($httpClient),
            'news' => $this->getNewsList($httpClient),
        ]);
    }
    public function getCategoyList($httpClient){
        $url = "https://raw.githubusercontent.com/JonasPoli/array-news/main/arrayCategoryNews.json";
        $html = $httpClient->request('GET',$url);
        $news = $html->toArray();
        return $news;
    }

    public function getNewsList($httpClient){
        $url = "https://raw.githubusercontent.com/JonasPoli/array-news/main/arrayNews.json";
        $html = $httpClient->request('GET',$url);
        $news = $html->toArray();
        return $news;
    }
}