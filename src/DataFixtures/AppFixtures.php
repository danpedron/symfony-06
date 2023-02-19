<?php

namespace App\DataFixtures;

use App\Entity\NewsCategory;
use App\Repository\NewsCategoryRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    
    public function load(ObjectManager $manager): void
    {
        $newsCategory = new NewsCategory();
        $newsCategory->setTitle("Mundo");
        $manager->persist($newsCategory);
        $manager->flush();


    }
}
