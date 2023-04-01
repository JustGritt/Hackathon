<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\HkVideoRepository;
use App\Repository\HkStatRepository;
use App\Entity\HkVideo;
use App\Form\HkVideoType;

use App\Entity\CommentaireVideo;
use App\Entity\HkStat;
use App\Form\CommentaireVideoType;
use App\Repository\CommentaireVideoRepository;


use App\Entity\Quiz;
use App\Repository\QuizRepository;

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
    public function engage(HkVideoRepository $hkVideoRepository, QuizRepository $quizRepository): Response
    {

        return $this->render('front/demo/engagement.html.twig', [
            'controller_name' => 'DemoController',
            'videos' => $hkVideoRepository->findAll(),
            'quizzes' => $quizRepository->findAll(),

        ]);
    }


    #[Route('/demo/engagement/video/{id}', name: 'app_demo_video', methods: ['GET'])]
    public function showClient(HkVideo $hkVideo,CommentaireVideoRepository $commentaireVideoRepository,HkStatRepository $hkStatRepository): Response
    {   
        $HkStat = new HkStat();
        $HkStat->addUserId($this->getUser());
        $HkStat->addVideoId($hkVideo);
        $hkStatRepository->save($HkStat, true);

        return $this->render('front/demo/showVideo.html.twig', [
            'hk_video' => $hkVideo,
        ]);
    }

    #[Route('/demo/engagement/quiz/{id}', name: 'app_demo_quiz', methods: ['GET'])]
    public function showClientQuiz(Quiz $quiz): Response
    {   
        /*
        $HkStat = new HkStat();
        $HkStat->addUserId($this->getUser());
        $HkStat->addVideoId($hkVideo);
        $hkStatRepository->save($HkStat, true);
        */
        return $this->render('front/demo/showQuiz.html.twig', [
            'quiz' => $quiz,
        ]);
    }

   
}


