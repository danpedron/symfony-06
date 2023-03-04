<?php

namespace App\Controller\Admin;

use App\Entity\News;
use App\Entity\NewsCategory;
use App\Entity\User;
use App\Repository\NewsCategoryRepository;
use App\Repository\NewsRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private NewsRepository $newsRepository,
        private NewsCategoryRepository $newsCategoryRepository,
    )
    {
    }


    #[Route('/admin', name: 'admin')]
    #[IsGranted('ROLE_USER')]
    public function index(): Response
    {
        if ($this->isGranted('ROLE_ADMIN')){
            return $this->render('admin/dashboard.html.twig',[
                'lastNews' => $this->newsRepository->findLastNews(10),
                'bestCategories' =>$this->newsCategoryRepository->findBestCategories(10),
            ]);
        } else {
            return $this->render('admin/dashboard.html.twig',[
                'lastNews' => $this->newsRepository->findLastNews(5),
                'bestCategories' =>$this->newsCategoryRepository->findBestCategories(5),
            ]);
        }


    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            // the name visible to end users
            ->setTitle('ACME Corp.')
            // you can include HTML contents too (e.g. to link to an image)
        // set this option if you prefer the page content to span the entire
        // browser width, instead of the default design which sets a max width
        ->renderContentMaximized();
    }


    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Usuários', 'fas fa-users', User::class);
        yield MenuItem::linkToCrud('Categoria de Notícias', 'fas fa-newspaper', NewsCategory::class);
        yield MenuItem::linkToCrud('Notícias', 'fas fa-newspaper', News::class);
    }
}
