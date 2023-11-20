<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimalRepository::class)]
class Animal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 128)]
    private ?string $nomAnimal = null;

    #[ORM\Column(length: 512)]
    private ?string $descriptionAnimal = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomAnimal(): ?string
    {
        return $this->nomAnimal;
    }

    public function setNomAnimal(string $nomAnimal): static
    {
        $this->nomAnimal = $nomAnimal;

        return $this;
    }

    public function getDescriptionAnimal(): ?string
    {
        return $this->descriptionAnimal;
    }

    public function setDescriptionAnimal(string $descriptionAnimal): static
    {
        $this->descriptionAnimal = $descriptionAnimal;

        return $this;
    }
}
