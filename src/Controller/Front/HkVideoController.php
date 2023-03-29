<?php

namespace App\Controller\Front;

use App\Entity\HkVideo;
use App\Form\HkVideoType;
use App\Repository\HkVideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
            $hkVideoRepository->save($hkVideo, true);

            return $this->redirectToRoute('front_app_hk_video_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('front/hk_video/new.html.twig', [
            'hk_video' => $hkVideo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_hk_video_show', methods: ['GET'])]
    public function show(HkVideo $hkVideo): Response
    {
        return $this->render('front/hk_video/show.html.twig', [
            'hk_video' => $hkVideo,
        ]);
    }
    #route edit
    #[Route('/{id}/edit', name: 'app_hk_video_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, HkVideo $hkVideo, HkVideoRepository $hkVideoRepository): Response
    {
        $form = $this->createForm(HkVideoType::class, $hkVideo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hkVideoRepository->save($hkVideo, true);

            return $this->redirectToRoute('app_hk_video_index', [], Response::HTTP_SEE_OTHER);
        }

        #test
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

        return $this->redirectToRoute('app_hk_video_index', [], Response::HTTP_SEE_OTHER);
    }
}
