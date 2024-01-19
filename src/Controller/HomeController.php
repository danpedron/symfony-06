<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    const categories = [
        ['title' => 'Mundo',      'text' => 'Notícias sobre o mundo'],
        ['title' => 'Brasil',     'text' => 'Notícias sobre o Brasil'],
        ['title' => 'Tecnologia', 'text' => 'Notícias sobre tecnologia'],
        ['title' => 'Design',     'text' => 'Notícias sobre design'],
        ['title' => 'Cultura',    'text' => 'Notícias sobre cultura'],
        ['title' => 'Negócios',   'text' => 'Notícias sobre negócios'],
        ['title' => 'Política',   'text' => 'Notícias sobre política'],
        ['title' => 'Opinião',    'text' => 'Notícias sobre opinião'],
        ['title' => 'Ciência',    'text' => 'Notícias sobre ciência'],
        ['title' => 'Saúde',      'text' => 'Notícias sobre saúde'],
        ['title' => 'Estilo',     'text' => 'Notícias sobre estilo'],
        ['title' => 'Viagens',    'text' => 'Notícias sobre viagens'],
    ];

    #[Route('/',name:'app_home')]
    public function new(): Response
    {
        $pageTitle = "Sistema de Notícias";
        return $this->render('home.html.twig', [
            'pageTitle' => $pageTitle,
            'categories' => self::categories,
        ]);
    }

    #[Route('/category/{slug}',name:'app_category')]
    public function category(string $slug=null): Response
    {
        $pageTitle = "Sistema de Notícias - Categorias sobre $slug";
        return $this->render('category.html.twig', [
            'pageTitle' => $slug,
            'categories' => self::categories,
        ]);
    }
}