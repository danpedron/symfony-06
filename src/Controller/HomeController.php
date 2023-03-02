<?php

namespace App\Controller;

use App\Entity\News;
use App\Entity\NewsCategory;
use App\Repository\NewsCategoryRepository;
use App\Repository\NewsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class HomeController extends AbstractController
{

    #[Route(path:'/', name: 'app_home')]
    public function home(NewsRepository $newsRepository, NewsCategoryRepository $newsCategoryRepository): Response
    {

        $categories =  $newsCategoryRepository->findAllCategoriesOrderByTitle();

        $pageTitle = "Sistema de Notícias";
        return $this->render('home.html.twig', [
            'pageTitle' => $pageTitle,
            'categories' => $categories,
        ]);
    }


    #[Route(path:'/category/{slug}', name: 'app_category_list')]
    public function category($slug, NewsCategoryRepository $newsCategoryRepository, NewsRepository $newsRepository): Response
    {
        $news =  $newsRepository->findByCategoryTitle($slug);
        $pageTitle = $slug;
        $categories =  $newsCategoryRepository->findAllCategoriesOrderByTitle();

        return $this->render('category.html.twig', [
            'pageTitle' => $pageTitle,
            'news' => $news,
            'categories' => $categories
        ]);
    }

    #[Route(path: '/pesquisa/', name: 'app_news_filter')]
    public function filter(Request $request,NewsRepository $newsRepository):Response
    {
        $search = $request->query->get('search');
        $listNews = $newsRepository->findBySearch($request->query->get('search'));

        return $this->render('search.html.twig',[
            'news' => $listNews,
            'search' => $search
        ]);
    }

}
