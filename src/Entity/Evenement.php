<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvenementRepository::class)]
class Evenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 256)]
    private ?string $nomEvenement = null;

    #[ORM\Column(length: 512)]
    private ?string $descriptionEvenement = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateEvenement = null;

    #[ORM\Column]
    private ?int $dureeEvenement = null;

    #[ORM\Column]
    private ?int $quotaVisiteurs = null;

    #[ORM\ManyToOne(inversedBy: 'evenements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Enclos $enclos = null;

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
}
