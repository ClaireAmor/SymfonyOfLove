<?php

namespace App\Controller;

use App\Entity\Frog;
use App\Form\FrogType;
use App\Repository\FrogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/frog')]
class FrogController extends AbstractController
{
    #[Route('/', name: 'app_frog_index', methods: ['GET', 'POST'])]
    public function index(Request $request, FrogRepository $frogRepository): Response
    {
        $frog = new Frog();
        $form = $this->createForm(FrogType::class, $frog);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            return $this->render('frog/index.html.twig', [
                'frogs' => $frogRepository->findAll(),
                'form' => $form,
            ]);
        }

        return $this->render('frog/index.html.twig', [
            'frogs' => $frogRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }

    #[Route('/new', name: 'app_frog_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FrogRepository $frogRepository): Response
    {
        $frog = new Frog();
        $form = $this->createForm(FrogType::class, $frog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $frogRepository->save($frog, true);

            return $this->redirectToRoute('app_frog_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('frog/new.html.twig', [
            'frog' => $frog,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_frog_show', methods: ['GET'])]
    public function show(Frog $frog): Response
    {
        return $this->render('frog/show.html.twig', [
            'frog' => $frog,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_frog_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Frog $frog, FrogRepository $frogRepository): Response
    {
        $form = $this->createForm(FrogType::class, $frog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $frogRepository->save($frog, true);

            return $this->redirectToRoute('app_frog_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('frog/edit.html.twig', [
            'frog' => $frog,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_frog_delete', methods: ['POST'])]
    public function delete(Request $request, Frog $frog, FrogRepository $frogRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$frog->getId(), $request->request->get('_token'))) {
            $frogRepository->remove($frog, true);
        }

        return $this->redirectToRoute('app_frog_index', [], Response::HTTP_SEE_OTHER);
    }
}
