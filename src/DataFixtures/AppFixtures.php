<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    // ...
    public function load(ObjectManager $manager)
    {
    
        $user = new User();
        $user->setFirstname('admin');
        $user->setLastname('admin');
        $user->setEmail('admin@admin.fr');
        $user->setBithdate(new \DateTime('06/04/2014'));

        $user->setIsVerified(true);
        $user->setRoles(['ROLE_ADMIN']);

        $password = $this->hasher->hashPassword($user, 'esgi1234');
        $user->setPassword($password);

        $manager->persist($user);
        $manager->flush();

        $modo = new User();
        $modo->setFirstname('modo');
        $modo->setLastname('modo');
        $modo->setEmail('modo@modo.fr');
        $modo->setIsVerified(true);
        $modo->setBithdate(new \DateTime('06/04/2014'));
        $modo->setRoles(['ROLE_MODERATOR']);

        $password = $this->hasher->hashPassword($modo, 'esgi1234');
        $modo->setPassword($password);

        $manager->persist($modo);
        $manager->flush();

        
    }
}