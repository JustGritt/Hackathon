<?php

namespace App\Controller\Front;

use App\Entity\HkVideo;
use App\Form\HkVideoType;
use App\Repository\HkVideoRepository;
use App\Repository\HkStatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\CommentaireVideo;
use App\Entity\HkStat;
use App\Form\CommentaireVideoType;
use App\Repository\CommentaireVideoRepository;

#[Route('/hk/video')]
class HkVideoController extends AbstractController
{
    #[Route('/', name: 'app_hk_video_index', methods: ['GET'])]
    public function index(HkVideoRepository $hkVideoRepository): Response
    {
        return $this->render('front/hk_video/index.html.twig', [
            'hk_videos' => $hkVideoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_hk_video_new', methods: ['GET', 'POST'])]
    public function new(Request $request, HkVideoRepository $hkVideoRepository): Response
    {
        $hkVideo = new HkVideo();
        $form = $this->createForm(HkVideoType::class, $hkVideo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $video = $form->get('link')->getData();
            $video = str_replace('watch?v=', 'embed/', $video);
            $video .= '?rel=0&amp;autoplay=1&mute=1';
            $hkVideo->setLink($video);
            $hkVideoRepository->save($hkVideo, true);
            return $this->redirectToRoute('front_app_hk_video_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('front/hk_video/new.html.twig', [
            'hk_video' => $hkVideo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_hk_video_show', methods: ['GET'])]
    public function show(HkVideo $hkVideo,CommentaireVideoRepository $commentaireVideoRepository,HkStatRepository $hkStatRepository): Response
    {   
        /*
        $HkStat = new HkStat();
        $HkStat->addUserId($this->getUser());
        $HkStat->addVideoId($hkVideo);
        */
        # on insert les vues, id user et id video
        #dd($HkStat);

        $comments =  $commentaireVideoRepository->findBy(array('video_id' => $hkVideo ->getId()));
        return $this->render('front/hk_video/show.html.twig', [
            'hk_video' => $hkVideo,
            'comments' => $comments
        ]);
    }

    #app_hk_video_valider
    #[Route('/{id}/valider', name: 'app_hk_video_valider', methods: ['GET', 'POST'])]
    public function valider(Request $request, HkVideo $hkVideo, HkVideoRepository $hkVideoRepository): Response
    {
        $hkVideo = $hkVideo->setActive(true);
        $hkVideo = $hkVideo->setRefused(false);
        $hkVideoRepository->save($hkVideo, true);

        return $this->redirectToRoute('front_app_hk_video_index', [], Response::HTTP_SEE_OTHER);

    }

    #app_hk_video_refused
    #[Route('/{id}/refused', name: 'app_hk_video_refused', methods: ['GET', 'POST'])]
    public function refused(Request $request, HkVideo $hkVideo, HkVideoRepository $hkVideoRepository,CommentaireVideoRepository $commentaireVideoRepositoryHkVideo): Response
    {
        $hkVideo = $hkVideo->setActive(false);
        $hkVideo = $hkVideo->setRefused(true);
        $hkVideoRepository->save($hkVideo, true);

        
        $commentaireVideo = new CommentaireVideo();
        $form = $this->createForm(CommentaireVideoType::class, $commentaireVideo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentaireVideo->setUserId($this->getUser());
            $commentaireVideo->setVideoId($hkVideo);
            $commentaireVideoRepositoryHkVideo->save($commentaireVideo, true);

            return $this->redirectToRoute('front_app_hk_video_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('front/commentaire_video/new.html.twig', [
            'commentaire_video' => $commentaireVideo,
            'video' =>  $hkVideo,
            'form' => $form
        ]);
    }

    

    #[Route('/{id}/edit', name: 'app_hk_video_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, HkVideo $hkVideo, HkVideoRepository $hkVideoRepository): Response
    {
        $form = $this->createForm(HkVideoType::class, $hkVideo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hkVideoRepository->save($hkVideo, true);

            return $this->redirectToRoute('front_app_hk_video_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('front/hk_video/edit.html.twig', [
            'hk_video' => $hkVideo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_hk_video_delete', methods: ['POST'])]
    public function delete(Request $request, HkVideo $hkVideo, HkVideoRepository $hkVideoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hkVideo->getId(), $request->request->get('_token'))) {
            $hkVideoRepository->remove($hkVideo, true);
        }

        return $this->redirectToRoute('front_app_hk_video_index', [], Response::HTTP_SEE_OTHER);
    }
}
