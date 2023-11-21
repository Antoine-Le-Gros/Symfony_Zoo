<?php

namespace App\Entity;

use App\Repository\EnclosRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnclosRepository::class)]
class Enclos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 128)]
    private ?string $nomEnclos = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEnclos(): ?string
    {
        return $this->nomEnclos;
    }

    public function setNomEnclos(string $nomEnclos): static
    {
        $this->nomEnclos = $nomEnclos;

        return $this;
    }
}
