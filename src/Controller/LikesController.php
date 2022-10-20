<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FrogRepository;

class LikesController extends AbstractController
{
    #[Route('/likes', name: 'app_likes', methods: ['GET'])]
    public function index(FrogRepository $frogRepository): Response
    {
        return $this->render('likes/index.html.twig', [
            'frogs' => $frogRepository->findAll(),
        ]);
    }
}
