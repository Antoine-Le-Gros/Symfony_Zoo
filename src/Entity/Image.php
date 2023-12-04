<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::BLOB)]
    private $image;

    #[ORM\OneToMany(mappedBy: 'image', targetEntity: Animal::class)]
    private Collection $animals;

    #[ORM\OneToMany(mappedBy: 'image', targetEntity: Espece::class)]
    private Collection $especes;

    #[ORM\OneToMany(mappedBy: 'image', targetEntity: FamilleAnimal::class)]
    private Collection $familleAnimals;

    #[ORM\OneToMany(mappedBy: 'image', targetEntity: CategorieAnimal::class)]
    private Collection $categorieAnimals;

    public function __construct()
    {
        $this->animals = new ArrayCollection();
        $this->especes = new ArrayCollection();
        $this->familleAnimals = new ArrayCollection();
        $this->categorieAnimals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): string
    {
        return 'data:image/png;base64,'.base64_encode(stream_get_contents($this->image));
    }

    public function setImage($image): static
    {
        $this->image = $image;

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
            $animal->setImage($this);
        }

        return $this;
    }

    public function removeAnimal(Animal $animal): static
    {
        if ($this->animals->removeElement($animal)) {
            // set the owning side to null (unless already changed)
            if ($animal->getImage() === $this) {
                $animal->setImage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Espece>
     */
    public function getEspeces(): Collection
    {
        return $this->especes;
    }

    public function addEspece(Espece $espece): static
    {
        if (!$this->especes->contains($espece)) {
            $this->especes->add($espece);
            $espece->setImage($this);
        }

        return $this;
    }

    public function removeEspece(Espece $espece): static
    {
        if ($this->especes->removeElement($espece)) {
            // set the owning side to null (unless already changed)
            if ($espece->getImage() === $this) {
                $espece->setImage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FamilleAnimal>
     */
    public function getFamilleAnimals(): Collection
    {
        return $this->familleAnimals;
    }

    public function addFamilleAnimal(FamilleAnimal $familleAnimal): static
    {
        if (!$this->familleAnimals->contains($familleAnimal)) {
            $this->familleAnimals->add($familleAnimal);
            $familleAnimal->setImage($this);
        }

        return $this;
    }

    public function removeFamilleAnimal(FamilleAnimal $familleAnimal): static
    {
        if ($this->familleAnimals->removeElement($familleAnimal)) {
            // set the owning side to null (unless already changed)
            if ($familleAnimal->getImage() === $this) {
                $familleAnimal->setImage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CategorieAnimal>
     */
    public function getCategorieAnimals(): Collection
    {
        return $this->categorieAnimals;
    }

    public function addCategorieAnimal(CategorieAnimal $categorieAnimal): static
    {
        if (!$this->categorieAnimals->contains($categorieAnimal)) {
            $this->categorieAnimals->add($categorieAnimal);
            $categorieAnimal->setImage($this);
        }

        return $this;
    }

    public function removeCategorieAnimal(CategorieAnimal $categorieAnimal): static
    {
        if ($this->categorieAnimals->removeElement($categorieAnimal)) {
            // set the owning side to null (unless already changed)
            if ($categorieAnimal->getImage() === $this) {
                $categorieAnimal->setImage(null);
            }
        }

        return $this;
    }
}
