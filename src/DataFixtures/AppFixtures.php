<?php

namespace App\DataFixtures;

use App\Entity\NewsCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // create 20 categories! Bam!
        for ($i = 0; $i < 20; $i++) {
            $category = new NewsCategory();
            $category->setTitle('Categoria '.$i);
            $manager->persist($category);
        }

        $manager->flush();
    }
}
