<?php

namespace App\Controller\Front;

use App\Entity\HkStat;
use App\Form\HkStatType;
use App\Repository\HkStatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/hk/stat')]
class HkStatController extends AbstractController
{
    #[Route('/', name: 'app_hk_stat_index', methods: ['GET'])]
    public function index(HkStatRepository $hkStatRepository): Response
    {
        return $this->render('front/hk_stat/index.html.twig', [
            'hk_stats' => $hkStatRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_hk_stat_new', methods: ['GET', 'POST'])]
    public function new(Request $request, HkStatRepository $hkStatRepository): Response
    {
        $hkStat = new HkStat();
        $form = $this->createForm(HkStatType::class, $hkStat);
       
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hkStatRepository->save($hkStat, true);

            return $this->redirectToRoute('front_app_hk_stat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('front/hk_stat/new.html.twig', [
            'hk_stat' => $hkStat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_hk_stat_show', methods: ['GET'])]
    public function show(HkStat $hkStat): Response
    {
        return $this->render('front/hk_stat/show.html.twig', [
            'hk_stat' => $hkStat,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_hk_stat_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, HkStat $hkStat, HkStatRepository $hkStatRepository): Response
    {
        $form = $this->createForm(HkStatType::class, $hkStat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hkStatRepository->save($hkStat, true);

            return $this->redirectToRoute('front_app_hk_stat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('front/hk_stat/edit.html.twig', [
            'hk_stat' => $hkStat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_hk_stat_delete', methods: ['POST'])]
    public function delete(Request $request, HkStat $hkStat, HkStatRepository $hkStatRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hkStat->getId(), $request->request->get('_token'))) {
            $hkStatRepository->remove($hkStat, true);
        }

        return $this->redirectToRoute('front_app_hk_stat_index', [], Response::HTTP_SEE_OTHER);
    }
}
