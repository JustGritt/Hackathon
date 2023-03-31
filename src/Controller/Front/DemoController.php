<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DemoController extends AbstractController
{
    #[Route('/demo', name: 'app_demo_homepage')]
    public function demo(): Response
    {
        return $this->render('front/demo/index.html.twig', [
            'controller_name' => 'DemoController',
        ]);
    }

    #[Route('/demo/engagement', name: 'app_demo_engagement')]
    public function engage(): Response
    {
        return $this->render('front/demo/engagement.html.twig', [
            'controller_name' => 'DemoController',
        ]);
    }
}
