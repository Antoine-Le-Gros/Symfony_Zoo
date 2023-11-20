<?php

namespace App\Entity;

use App\Repository\RegimeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RegimeRepository::class)]
class Regime
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 128)]
    private ?string $nomRegime = null;

    #[ORM\OneToMany(mappedBy: 'regime', targetEntity: Espece::class, orphanRemoval: true)]
    private Collection $especes;

    public function __construct()
    {
        $this->especes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomRegime(): ?string
    {
        return $this->nomRegime;
    }

    public function setNomRegime(string $nomRegime): static
    {
        $this->nomRegime = $nomRegime;

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
            $espece->setRegime($this);
        }

        return $this;
    }

    public function removeEspece(Espece $espece): static
    {
        if ($this->especes->removeElement($espece)) {
            // set the owning side to null (unless already changed)
            if ($espece->getRegime() === $this) {
                $espece->setRegime(null);
            }
        }

        return $this;
    }
}
