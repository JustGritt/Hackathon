<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category;
use Faker;


class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        
        for ($i = 0; $i < 10; $i++) {
            $category = new Category();
            $category->setName($faker->name);
            $category->setIsActive($faker->boolean);
            $category->setMinAge($faker->numberBetween(0, 25));
            $category->setMaxAge($faker->numberBetween(25, 100));
            $category->setOwner($this->getReference('user_0'));

            $this->addReference('category_' . $i, $category);
            $manager->persist($category);
            $manager->flush();
        }
    }
}
