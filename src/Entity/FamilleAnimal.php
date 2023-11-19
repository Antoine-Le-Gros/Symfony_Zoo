<?php

namespace App\Entity;

use App\Repository\FamilleAnimalRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FamilleAnimalRepository::class)]
class FamilleAnimal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 128)]
    private ?string $nomFamille = null;

    #[ORM\Column(length: 512)]
    private ?string $descriptionFamille = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomFamille(): ?string
    {
        return $this->nomFamille;
    }

    public function setNomFamille(string $nomFamille): static
    {
        $this->nomFamille = $nomFamille;

        return $this;
    }

    public function getDescriptionFamille(): ?string
    {
        return $this->descriptionFamille;
    }

    public function setDescriptionFamille(string $descriptionFamille): static
    {
        $this->descriptionFamille = $descriptionFamille;

        return $this;
    }
}
