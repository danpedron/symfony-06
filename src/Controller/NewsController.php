<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends AbstractController
{
    #[Route('api/news/{id}')]
    public function getNew(string $id=null): Response
    {
        // TODO - Criar uma query real
        $new = [
            'id' => $id,
            'titulo' => 'Artista brasileiro é premiado'
        ];
        return new JsonResponse($new);
    }

}
