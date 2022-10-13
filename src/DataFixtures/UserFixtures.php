<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Role\Role;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $user1 = $this->createUser("renette@gmaik.com", "Josette", "motdepasse");

        $manager->persist($user1);

        $manager->flush();
    }

    public function createUser(string $email, string $name, string $password)
    {
        $user = new User();
        $user->setFrog($this->getReference(FrogFixtures::FROG1_REFERENCE));
        $user->setEmail($email);
        $user->setName($name);
        $user->setPassword($password);

        return $user;
    }

    public function getDependencies()
    {
        return [
            FrogFixtures::class,
        ];
    }
}
