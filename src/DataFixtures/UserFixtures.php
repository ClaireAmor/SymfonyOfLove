<?php

namespace App\DataFixtures;

use App\Entity\Frog;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    private $userPasswordHasherInterface;

    public function __construct (UserPasswordHasherInterface $userPasswordHasherInterface) 
    {
        $this->userPasswordHasherInterface = $userPasswordHasherInterface;
    }

    public function load(ObjectManager $manager): void
    {
        for ($count = 0; $count < 20; $count++) {
            $user = $this->createUser(
                $this->getReference("FROG_REFERENCE" . $count),
                "user{$count}@gmail.com",
                "user{$count}",
                "motdepasse"
            );
            $manager->persist($user);
        }
        $manager->flush();
    }

    public function createUser(Frog $frog, string $email, string $name, string $password)
    {
        $user = new User();
        $user->setFrog($frog);
        $user->setEmail($email);
        $user->setName($name);
        $user->setPassword(
            $this->userPasswordHasherInterface->hashPassword(
                $user,
                $password
            )
        );

        return $user;
    }

    public function getDependencies()
    {
        return [
            FrogFixtures::class,
        ];
    }
}
