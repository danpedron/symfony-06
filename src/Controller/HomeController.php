<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    #[Route(path:'/', name: 'app_home')]
    public function home(): Response
    {
        $categories = [
            ['title' => 'Mundo',      'text' => 'Notícias sobre o Mundo'],
            ['title' => 'Brasil',     'text' => 'Notícias sobre o Brasil'],
            ['title' => 'Tecnologia', 'text' => 'Notícias sobre Tecnologia'],
            ['title' => 'Design',     'text' => 'Notícias sobre Design'],
            ['title' => 'Cultura',    'text' => 'Notícias sobre Cultura'],
            ['title' => 'Negócios',   'text' => 'Notícias sobre Negócios'],
            ['title' => 'Política',   'text' => 'Notícias sobre Política'],
            ['title' => 'Opinião',    'text' => 'Notícias sobre Opinião'],
            ['title' => 'Ciência',    'text' => 'Notícias sobre Ciência'],
            ['title' => 'Saúde',      'text' => 'Notícias sobre Saúde'],
            ['title' => 'Estilo',     'text' => 'Notícias sobre Estilo de vida'],
            ['title' => 'Viagens',    'text' => 'Notícias sobre Viagens'],
        ];
        $pageTitle = "Sistema de Notícias";
        return $this->render('home.html.twig', [
            'pageTitle' => $pageTitle,
            'categories' => $categories,
        ]);
    }

    #[Route(path:'/category/{slug}', name: 'app_category_list')]
    public function category($slug): Response
    {
        $pageTitle = $slug;
        $categories = [
            ['title' => 'Mundo',      'text' => 'Notícias sobre o Mundo'],
            ['title' => 'Brasil',     'text' => 'Notícias sobre o Brasil'],
            ['title' => 'Tecnologia', 'text' => 'Notícias sobre Tecnologia'],
            ['title' => 'Design',     'text' => 'Notícias sobre Design'],
            ['title' => 'Cultura',    'text' => 'Notícias sobre Cultura'],
            ['title' => 'Negócios',   'text' => 'Notícias sobre Negócios'],
            ['title' => 'Política',   'text' => 'Notícias sobre Política'],
            ['title' => 'Opinião',    'text' => 'Notícias sobre Opinião'],
            ['title' => 'Ciência',    'text' => 'Notícias sobre Ciência'],
            ['title' => 'Saúde',      'text' => 'Notícias sobre Saúde'],
            ['title' => 'Estilo',     'text' => 'Notícias sobre Estilo de vida'],
            ['title' => 'Viagens',    'text' => 'Notícias sobre Viagens'],
        ];
        return $this->render('category.html.twig', [
            'pageTitle' => $pageTitle,
            'categories' => $categories,
        ]);
    }
}