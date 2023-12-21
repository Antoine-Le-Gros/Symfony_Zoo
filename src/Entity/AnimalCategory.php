<?php

namespace App\Entity;

use App\Repository\AnimalCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimalCategoryRepository::class)]
class AnimalCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 128)]
    private ?string $name = null;

    #[ORM\Column(length: 512)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: AnimalFamily::class, orphanRemoval: true)]
    private Collection $animalFamilies;

    #[ORM\ManyToOne(inversedBy: 'AnimalsCategory')]
    private ?Image $image = null;

    public function __construct()
    {
        $this->animalsFamily = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getAnimalsFamily(): Collection
    {
        return $this->animalsFamily;
    }

    public function addAnimalFamily(AnimalFamily $AnimalFamily): static
    {
        if (!$this->animalsFamily->contains($AnimalFamily)) {
            $this->animalsFamily->add($AnimalFamily);
            $AnimalFamily->setCategory($this);
        }

        return $this;
    }

    public function removeAnimalFamily(AnimalFamily $animalFamily): static
    {
        if ($this->animalsFamily->removeElement($animalFamily)) {
            // set the owning side to null (unless already changed)
            if ($animalFamily->getCategory() === $this) {
                $animalFamily->setCategory(null);
            }
        }

        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): static
    {
        $this->image = $image;

        return $this;
    }
}
