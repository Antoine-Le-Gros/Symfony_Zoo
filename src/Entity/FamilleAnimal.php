<?php

namespace App\Entity;

use App\Repository\FamilleAnimalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(mappedBy: 'famille', targetEntity: Espece::class, orphanRemoval: true)]
    private Collection $especes;

    public function __construct()
    {
        $this->especes = new ArrayCollection();
    }

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
            $espece->setFamille($this);
        }

        return $this;
    }

    public function removeEspece(Espece $espece): static
    {
        if ($this->especes->removeElement($espece)) {
            // set the owning side to null (unless already changed)
            if ($espece->getFamille() === $this) {
                $espece->setFamille(null);
            }
        }

        return $this;
    }
}
