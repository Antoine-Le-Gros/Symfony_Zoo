<?php

namespace App\Entity;

use App\Repository\EspeceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EspeceRepository::class)]
class Espece
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 128)]
    private ?string $libEspece = null;

    #[ORM\Column(length: 512)]
    private ?string $descriptionEspece = null;

    #[ORM\OneToMany(mappedBy: 'espece', targetEntity: Animal::class, orphanRemoval: true)]
    private Collection $animals;

    #[ORM\ManyToOne(inversedBy: 'especes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?FamilleAnimal $famille = null;

    #[ORM\ManyToOne(inversedBy: 'especes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Regime $regime = null;

    public function __construct()
    {
        $this->animals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibEspece(): ?string
    {
        return $this->libEspece;
    }

    public function setLibEspece(string $libEspece): static
    {
        $this->libEspece = $libEspece;

        return $this;
    }

    public function getDescriptionEspece(): ?string
    {
        return $this->descriptionEspece;
    }

    public function setDescriptionEspece(string $descriptionEspece): static
    {
        $this->descriptionEspece = $descriptionEspece;

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
            $animal->setEspece($this);
        }

        return $this;
    }

    public function removeAnimal(Animal $animal): static
    {
        if ($this->animals->removeElement($animal)) {
            // set the owning side to null (unless already changed)
            if ($animal->getEspece() === $this) {
                $animal->setEspece(null);
            }
        }

        return $this;
    }

    public function getFamille(): ?FamilleAnimal
    {
        return $this->famille;
    }

    public function setFamille(?FamilleAnimal $famille): static
    {
        $this->famille = $famille;

        return $this;
    }

    public function getRegime(): ?Regime
    {
        return $this->regime;
    }

    public function setRegime(?Regime $regime): static
    {
        $this->regime = $regime;

        return $this;
    }
}
