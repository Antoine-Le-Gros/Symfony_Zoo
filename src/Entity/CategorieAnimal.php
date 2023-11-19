<?php

namespace App\Entity;

use App\Repository\CategorieAnimalRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieAnimalRepository::class)]
class CategorieAnimal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 128)]
    private ?string $nomCategorie = null;

    #[ORM\Column(length: 512)]
    private ?string $descriptionCategorie = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCategorie(): ?string
    {
        return $this->nomCategorie;
    }

    public function setNomCategorie(string $nomCategorie): static
    {
        $this->nomCategorie = $nomCategorie;

        return $this;
    }

    public function getDescriptionCategorie(): ?string
    {
        return $this->descriptionCategorie;
    }

    public function setDescriptionCategorie(string $descriptionCategorie): static
    {
        $this->descriptionCategorie = $descriptionCategorie;

        return $this;
    }
}
