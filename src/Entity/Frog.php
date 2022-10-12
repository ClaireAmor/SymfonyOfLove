<?php

namespace App\Entity;

use App\Repository\FrogRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FrogRepository::class)]
class Frog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 128)]
    private ?string $specie = null;

    #[ORM\Column]
    private ?int $size = null;

    #[ORM\Column(length: 128)]
    private ?string $skinColor = null;

    #[ORM\OneToOne(mappedBy: 'frog', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSpecie(): ?string
    {
        return $this->specie;
    }

    public function setSpecie(string $specie): self
    {
        $this->specie = $specie;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getSkinColor(): ?string
    {
        return $this->skinColor;
    }

    public function setSkinColor(string $skinColor): self
    {
        $this->skinColor = $skinColor;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        // set the owning side of the relation if necessary
        if ($user->getFrog() !== $this) {
            $user->setFrog($this);
        }

        $this->user = $user;

        return $this;
    }
}
