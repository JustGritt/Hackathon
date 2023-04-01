<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use App\Entity\Question;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class QuestionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Faker\Factory::create('fr_FR');
        for($i = 0; $i < 20; $i++)
        {
            $question = new Question();
            $question->setContent($faker->words(15, true). '?');
            $question->setQuiz($this->getReference('quiz_'.rand(0, 9)));
            $manager->persist($question);
            $manager->flush();
        }
        
    }

    public function getDependencies()
    {
        return array(
            QuizFixtures::class,
        );
    }
}
