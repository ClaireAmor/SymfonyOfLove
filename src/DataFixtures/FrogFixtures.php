<?php

namespace App\DataFixtures;

use App\Entity\Frog;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FrogFixtures extends Fixture
{
    public const FROG1_REFERENCE = "frog1";
    public function load(ObjectManager $manager): void
    {
        $frog1 = $this->createFrog("Rana ridibunda", "blue", 12);
        $frog2 = $this->createFrog("Pelophylax lessonae", "red", 23);

        $manager->persist($frog1);
        $manager->persist($frog2);
        $manager->flush();

        $this->addReference(self::FROG1_REFERENCE, $frog1);
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
