<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EvenementRepository::class)]
class Evenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 256)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 256)]
    private ?string $nomEvenement = null;

    #[ORM\Column(length: 512)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 512)]
    private ?string $descriptionEvenement = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\NotBlank]
    private ?\DateTimeInterface $dateEvenement = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?int $dureeEvenement = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?int $quotaVisiteurs = null;

    #[ORM\ManyToOne(inversedBy: 'evenements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Enclos $enclos = null;

    #[ORM\OneToMany(mappedBy: 'evenement', targetEntity: Inscription::class, orphanRemoval: true)]
    private Collection $inscriptions;

    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEvenement(): ?string
    {
        return $this->nomEvenement;
    }

    public function setNomEvenement(string $nomEvenement): static
    {
        $this->nomEvenement = $nomEvenement;

        return $this;
    }

    public function getDescriptionEvenement(): ?string
    {
        return $this->descriptionEvenement;
    }

    public function setDescriptionEvenement(string $descriptionEvenement): static
    {
        $this->descriptionEvenement = $descriptionEvenement;

        return $this;
    }

    public function getDateEvenement(): ?\DateTimeInterface
    {
        return $this->dateEvenement;
    }

    public function setDateEvenement(\DateTimeInterface $dateEvenement): static
    {
        $this->dateEvenement = $dateEvenement;

        return $this;
    }

    public function getDureeEvenement(): ?int
    {
        return $this->dureeEvenement;
    }

    public function setDureeEvenement(int $dureeEvenement): static
    {
        $this->dureeEvenement = $dureeEvenement;

        return $this;
    }

    public function getQuotaVisiteurs(): ?int
    {
        return $this->quotaVisiteurs;
    }

    public function setQuotaVisiteurs(int $quotaVisiteurs): static
    {
        $this->quotaVisiteurs = $quotaVisiteurs;

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

    /**
     * @return Collection<int, Inscription>
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function addInscription(Inscription $inscription): static
    {
        if (!$this->inscriptions->contains($inscription)) {
            $this->inscriptions->add($inscription);
            $inscription->setEvenement($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): static
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getEvenement() === $this) {
                $inscription->setEvenement(null);
            }
        }

        return $this;
    }
}
