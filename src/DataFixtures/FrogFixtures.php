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
        $species = array(
            'Rainette méridionale',
            'Rainette ibérique',
            'Rainette sarde',
            'Grenouille taureau',
            'Grenouille de Lessona',
            'Grenouille rieuse',
            'Sonneur à ventre jaune',
            'Crapaud commun',
        );
        $color = array(
            'blue',
            'green',
            'yellow',
            'red',
            'pink',
            'gray',
            'black',
            'white',
        );
        $size = array(
            3,
            5,
            7,
            8,
            9,
            10,
            11,
            12,
        );
        for ($count = 0; $count < 20; $count++) {
            $frog = $this->createFrog($species[array_rand($species)], $color[array_rand($color)], $size[array_rand($size)]);
            $manager->persist($frog);
            $this->addReference("FROG_REFERENCE" . $count, $frog);
        }
        $manager->flush();   
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
