<?php

namespace App\Command;

use App\Entity\NewsCategory;
use App\Repository\NewsCategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:add-categories',
    description: 'Adicionar caterias de notícias',
)]
class AddCategoriesCommand extends Command
{

    public function __construct(private NewsCategoryRepository $categoryRepository)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        die('Não vou mais executar');
        $newsCategory = new NewsCategory();
        $newsCategory->setTitle("Mundo");
        $this->categoryRepository->save($newsCategory, true);

        $newsCategory = new NewsCategory();
        $newsCategory->setTitle("Brasil");
        $this->categoryRepository->save($newsCategory, true);

        $newsCategory = new NewsCategory();
        $newsCategory->setTitle("Design");
        $this->categoryRepository->save($newsCategory, true);

        $newsCategory = new NewsCategory();
        $newsCategory->setTitle("Cultura");
        $this->categoryRepository->save($newsCategory, true);

        $newsCategory = new NewsCategory();
        $newsCategory->setTitle("Negócios");
        $this->categoryRepository->save($newsCategory, true);

        $newsCategory = new NewsCategory();
        $newsCategory->setTitle("Política");
        $this->categoryRepository->save($newsCategory, true);

        $newsCategory = new NewsCategory();
        $newsCategory->setTitle("Tecnologia");
        $this->categoryRepository->save($newsCategory, true);

        $newsCategory = new NewsCategory();
        $newsCategory->setTitle("Opinião");
        $this->categoryRepository->save($newsCategory, true);

        $newsCategory = new NewsCategory();
        $newsCategory->setTitle("Ciência");
        $this->categoryRepository->save($newsCategory, true);

        $newsCategory = new NewsCategory();
        $newsCategory->setTitle("Saúde");
        $this->categoryRepository->save($newsCategory, true);

        $newsCategory = new NewsCategory();
        $newsCategory->setTitle("Estilo");
        $this->categoryRepository->save($newsCategory, true);

        $newsCategory = new NewsCategory();
        $newsCategory->setTitle("Viagens");
        $this->categoryRepository->save($newsCategory, true);


        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
