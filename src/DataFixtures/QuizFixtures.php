<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Quiz;
use Faker;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Handler\UploadHandler;
use Symfony\Component\HttpFoundation\File\File;

use Symfony\Component\VarDumper\VarDumper;
use Faker\Provider\Base;


class QuizFixtures extends Fixture
{
    private $uploadHandler;
    
    public function __construct(UploadHandler $uploadHandler)
    {
        $this->uploadHandler = $uploadHandler;
    }
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Faker\Factory::create('fr_FR');
        for($i = 0; $i < 10; $i++)
        {
            
            $quiz = new Quiz();
            $quiz->setName($faker->name);
            $quiz->setIsActive(true);
            $quiz->setIsDraft(false);
            $quiz->setIsPublished(true);
            $quiz->setIsRefused(false);
            $quiz->setIsWaiting(false);
           
            //create a copy of the file /public/img/quiz.png
            $fileCopy = 'public/img/hero-engagement.png';
            $fileName = 'public/img/'.uniqid().'.png';
            copy($fileCopy, $fileName);


            $imageFile = new UploadedFile(
                $fileName,
                $fileName,
                'image/png',
                null,
                true
            );
            
            /*
            $image = $faker->image('public/img', 640, 480, 'cats', false);
            $imageFile = new UploadedFile(
                'public/img/'.$image,
                'public/img/'.$image,
                'image/jpg',
                null,
                true
            );
            */
            $quiz->setImageFile($imageFile);
            $this->uploadHandler->upload($quiz, 'imageFile');
            
            $quiz->setDescription($faker->words(15, true));
            $quiz->setCategory($this->getReference('category_' . $faker->numberBetween(0, 9)));
            $quiz->setCreatedBy($this->getReference('user_0'));
        
            $manager->persist($quiz);
            $manager->flush();
        
        }
    }
}
