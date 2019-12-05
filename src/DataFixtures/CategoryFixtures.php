<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    const CATEGORIES = [
        'Action',
        'Comédie',
        'Horreur',
        'Sci-Fi',
        'Fantastique',
        'Aventure',
        'Animation',
        'Romance',
        'Drama'
    ];

    public function load(ObjectManager $manager) {
        foreach (self::CATEGORIES as $key => $categoryName) {
            $category = new Category();
            $category->setName($categoryName);
            $this->addReference('categorie_' . $key, $category);

            $manager->persist($category);
        }

        $manager->flush();
    }
}