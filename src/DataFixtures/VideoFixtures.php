<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use App\Entity\HkVideo;

class VideoFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Faker\Factory::create('fr_FR');

        //create an array of links of random youtube videos
        $links = [
           
            'https://www.youtube.com/embed/dQw4w9WgXcQ',
            'https://www.youtube.com/embed/dQw4w9WgXcQ',
            'https://www.youtube.com/embed/dQw4w9WgXcQ',
            'https://www.youtube.com/embed/dQw4w9WgXcQ',
            'https://www.youtube.com/embed/dQw4w9WgXcQ',
            'https://www.youtube.com/embed/dQw4w9WgXcQ',
            'https://www.youtube.com/embed/dQw4w9WgXcQ',
            'https://www.youtube.com/embed/dQw4w9WgXcQ',
            'https://www.youtube.com/embed/dQw4w9WgXcQ',
            'https://www.youtube.com/embed/dQw4w9WgXcQ',
            'https://www.youtube.com/embed/dQw4w9WgXcQ',
            'https://www.youtube.com/embed/dQw4w9WgXcQ',
            'https://www.youtube.com/embed/dQw4w9WgXcQ',
            'https://www.youtube.com/embed/dQw4w9WgXcQ',
            'https://www.youtube.com/embed/dQw4w9WgXcQ',
        ];
      
        for($i = 0; $i < 10; $i++)
        {
            $video = new HkVideo();
            $video->setTitle($faker->name);
            $video->setLink($links[rand(0, 14)]);
            $video->setActive(true);
            $video->setRefused(false);
            $video->setPublish(true);
            $video->setWaiting(false);
            $video->setDescription($faker->words(15, true));
            $video->setCategory($this->getReference('category_' . $faker->numberBetween(0, 9)));
        
            $manager->persist($video);
            $manager->flush();
        }

      
    }
}
