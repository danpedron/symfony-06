<?php

namespace App\Controller;

use App\Entity\News;
use App\Entity\NewsCategory;
use App\Repository\NewsCategoryRepository;
use App\Repository\NewsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
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
    public function category($slug, Request $request, NewsCategoryRepository $newsCategoryRepository, NewsRepository $newsRepository): Response
    {
        $queryBuilder = $newsRepository->createQueryBuilderByCategoryTitle($slug);
        $adapter = new QueryAdapter($queryBuilder);
        $pagerFanta = Pagerfanta::createForCurrentPageWithMaxPerPage(
            $adapter,
            $request->query->get('page',1),
            6
        );

        $pageTitle = $slug;
        $categories =  $newsCategoryRepository->findAllCategoriesOrderByTitle();

        return $this->render('category.html.twig', [
            'pageTitle' => $pageTitle,
            'pager' => $pagerFanta,
            'categories' => $categories
        ]);
    }

    #[Route(path: '/pesquisa/', name: 'app_news_filter')]
    public function filter(Request $request,NewsRepository $newsRepository):Response
    {
        $search = $request->query->get('search');
        // $listNews = $newsRepository->findBySearch($request->query->get('search'));
        $queryBuilder = $newsRepository->createQueryBuilderBySearch($search);
        $adapter = new QueryAdapter($queryBuilder);
        $pagerFanta = Pagerfanta::createForCurrentPageWithMaxPerPage(
            $adapter,
            $request->query->get('page',1),
            6
        );

        return $this->render('search.html.twig',[
            'pager' => $pagerFanta,
            'search' => $search
        ]);
    }

    #[Route(path: '/news/{slug}', name: 'app_news_detail')]
    public function newsDetail(News $news=null):Response
    {

        if (!$news){
            throw $this->createNotFoundException('Notícia não encontrada');
        }

        return $this->render('newsDetail.html.twig',[
            'news' => $news,
        ]);

    }

}
