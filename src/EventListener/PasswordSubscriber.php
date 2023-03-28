<?php

// src/EventListener/DatabaseActivitySubscriber.php
namespace App\EventListener;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class PasswordSubscriber implements EventSubscriberInterface
{
   
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    
    public function getSubscribedEvents(): array
    {
        return [
            Events::prePersist,
            Events::preUpdate,
        ];
    }

    public function prePersist(LifecycleEventArgs $args)
    {

        $user = $args->getObject();
        if (!$user instanceof User) return;
        $this->encodePassword($user);
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $user = $args->getObject();
        if (!$user instanceof User) return;
        $this->encodePassword($user);
    }

    public function encodePassword(User $user)
    {
        if ($user->getPlainPassword() === null) {
           return;
        }
        $user->setPassword($this->hasher->hashPassword(
            $user,
            $user->getPlainPassword(),
        ));
    }
}