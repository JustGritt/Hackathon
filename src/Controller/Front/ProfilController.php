<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use App\Entity\User;
use App\Form\UpdateProfilFormType;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function edit(UserRepository $userRepository, Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UpdateProfilFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);
            $this->addFlash('success', 'Your profil is updated!');
            return $this->redirectToRoute('front_app_team');
        }

        return $this->renderForm('front/profil/index.html.twig', [
            'updateProfilForm' => $form
        ]);
    }
}
