<?php

namespace App\Controller;

use Psr\Cache\CacheItemInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;


class HomeController extends AbstractController
{

    #[Route(path:'/', name: 'app_home')]
    public function home(HttpClientInterface $httpClient, CacheInterface $cache): Response
    {
        $categories = $cache->get('news_data', function (CacheItemInterface $cacheItem) use ($httpClient){
            $cacheItem->expiresAfter(5);
            $response = $httpClient->request('GET', 'https://raw.githubusercontent.com/JonasPoli/array-news/main/arrayCategoryNews.json');
            return $response->toArray();
        });




        $pageTitle = "Sistema de Notícias";
        return $this->render('home.html.twig', [
            'pageTitle' => $pageTitle,
            'categories' => $categories,
        ]);
    }

    #[Route(path:'/category/{slug}', name: 'app_category_list')]
    public function category($slug, HttpClientInterface $httpClient): Response
    {
        $response = $httpClient->request('GET','https://raw.githubusercontent.com/JonasPoli/array-news/6592605d783b39aa2edac63868959ded7ef700ec/arrayNews.json');
        $news = $response->toArray();

        $response = $httpClient->request('GET', 'https://raw.githubusercontent.com/JonasPoli/array-news/main/arrayCategoryNews.json');
        $categories = $response->toArray();

        $pageTitle = $slug;

        return $this->render('category.html.twig', [
            'pageTitle' => $pageTitle,
            'categories' => $categories,
            'news' => $news,
        ]);
    }

}