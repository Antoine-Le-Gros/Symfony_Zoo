<?php

namespace App\Entity;

use App\Repository\EnclosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(mappedBy: 'enclos', targetEntity: Animal::class)]
    private Collection $animals;

    public function __construct()
    {
        $this->animals = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Animal>
     */
    public function getAnimals(): Collection
    {
        return $this->animals;
    }

    public function addAnimal(Animal $animal): static
    {
        if (!$this->animals->contains($animal)) {
            $this->animals->add($animal);
            $animal->setEnclos($this);
        }

        return $this;
    }

    public function removeAnimal(Animal $animal): static
    {
        if ($this->animals->removeElement($animal)) {
            // set the owning side to null (unless already changed)
            if ($animal->getEnclos() === $this) {
                $animal->setEnclos(null);
            }
        }

        return $this;
    }
}
