<?php

namespace App\Controller;

use App\Entity\Frog;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();

        $form = $this->createForm(UserType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            dump($form->getData());
            $user = $form->getData();
            // encode the plain password
            /* $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );*/

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_user_show', [
                'id' => $user->getId()
            ]);
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    public function createUser(Frog $frog, string $email, string $name, string $password)
    {
        $user = new User();
        $user->setFrog($frog);
        $user->setEmail($email);
        $user->setName($name);
        $user->setPassword($password);

        return $user;
    }

    public function createFrog(string $specie, string $color, int $size)
    {
        $frog = new Frog();
        $frog->setSpecie($specie);
        $frog->setSkinColor($color);
        $frog->setSize($size);

        return $frog;
    }
}
