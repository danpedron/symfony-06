<?php

namespace App\Controller;

use App\Entity\News;
use App\Entity\NewsCategory;
use App\Service\NewsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class HomeController extends AbstractController
{

    #[Route(path:'/', name: 'app_home')]
    public function home(NewsRepository $newsRepository): Response
    {
        $categories = $newsRepository->findAllCategories();

        $pageTitle = "Sistema de Notícias";
        return $this->render('home.html.twig', [
            'pageTitle' => $pageTitle,
            'categories' => $categories,
        ]);
    }


    #[Route(path:'/category/{slug}', name: 'app_category_list')]
    public function category($slug, EntityManagerInterface $entityManager): Response
    {
        $newsRepository = $entityManager->getRepository(News::class);
        $news =  $newsRepository->findByCategoryTitle($slug);
        $pageTitle = $slug;

        $newsCategoryRepository = $entityManager->getRepository(NewsCategory::class);
        $categories =  $newsCategoryRepository->findBy([],['title'=>'ASC']);

        return $this->render('category.html.twig', [
            'pageTitle' => $pageTitle,
            'news' => $news,
            'categories' => $categories
        ]);
    }

}
