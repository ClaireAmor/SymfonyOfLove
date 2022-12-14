<?php

namespace App\Controller;

use App\Entity\Frog;
use App\Entity\User;
use App\Entity\SearchData;
use App\Form\SearchForm;
use App\Repository\FrogRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(UserRepository $userRepository, Request $request): Response
    {

        // usually you'll want to make sure the user is authenticated first,
        // see "Authorization" below
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // returns your User object, or null if the user is not authenticated
        // use inline documentation to tell your editor your exact User class
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        $data = new SearchData();
        $form = $this->createForm(SearchForm::class, $data);
        $form->handleRequest($request);
        $users = $userRepository->findSearch($data);

        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
            'users' => $users,
            'form' => $form->createView()
        ]);
    }

    #[Route('/profile/like/{id}', name: 'add_frog')]
    public function addFrog(User $test,  UserRepository $userRepository)
    {
        $userRepository->like($this->getUser(), $test->getFrog()->getId());
        return $this->redirectToRoute('app_profile');
    }
}