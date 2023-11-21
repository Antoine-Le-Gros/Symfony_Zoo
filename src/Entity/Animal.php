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

    #[ORM\ManyToOne(inversedBy: 'animals')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Espece $espece = null;

    #[ORM\ManyToOne(inversedBy: 'animals')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Enclos $enclos = null;

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

    public function getEspece(): ?Espece
    {
        return $this->espece;
    }

    public function setEspece(?Espece $espece): static
    {
        $this->espece = $espece;

        return $this;
    }

    public function getEnclos(): ?Enclos
    {
        return $this->enclos;
    }

    public function setEnclos(?Enclos $enclos): static
    {
        $this->enclos = $enclos;

        return $this;
    }
}
