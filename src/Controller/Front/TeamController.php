<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use App\Form\UpdateUserFormType;
use App\Entity\User;

class TeamController extends AbstractController
{
    #[Route('/team', name: 'app_team')]
    public function index(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();
        return $this->render('front/team/index.html.twig', [
            'users' => $users,
        ]);
    }


    #[Route('/team/{id}/edit', name: 'app_team_edit')]
    #[Security("is_granted('ROLE_ADMIN')")]
    public function editOne(User $user, UserRepository $userRepository, Request $request): Response
    {
       
        $form = $this->createForm(UpdateUserFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);
            $this->addFlash('success', 'Employee updated!');
            return $this->redirectToRoute('front_app_team');
        }

        return $this->renderForm('front/team/show.html.twig', [
            'updateEmployeeForm' => $form
        ]);
        
    }
    

}
