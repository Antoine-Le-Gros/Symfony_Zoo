<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $loginUser = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $mdpUser = null;

    #[ORM\Column(length: 128)]
    private ?string $nomUser = null;

    #[ORM\Column(length: 128)]
    private ?string $pnomUser = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateNaisUser = null;

    #[ORM\Column(length: 256)]
    private ?string $emailUser = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateEmbauche = null;

    #[ORM\Column(nullable: true)]
    private ?int $dureeContrat = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateVisiteur = null;

    #[ORM\Column(length: 1)]
    private ?string $role = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLoginUser(): ?string
    {
        return $this->loginUser;
    }

    public function setLoginUser(string $loginUser): static
    {
        $this->loginUser = $loginUser;

        return $this;
    }

    public function getMdpUser(): ?string
    {
        return $this->mdpUser;
    }

    public function setMdpUser(string $mdpUser): static
    {
        $this->mdpUser = $mdpUser;

        return $this;
    }

    public function getNomUser(): ?string
    {
        return $this->nomUser;
    }

    public function setNomUser(string $nomUser): static
    {
        $this->nomUser = $nomUser;

        return $this;
    }

    public function getPnomUser(): ?string
    {
        return $this->pnomUser;
    }

    public function setPnomUser(string $pnomUser): static
    {
        $this->pnomUser = $pnomUser;

        return $this;
    }

    public function getDateNaisUser(): ?\DateTimeInterface
    {
        return $this->dateNaisUser;
    }

    public function setDateNaisUser(\DateTimeInterface $dateNaisUser): static
    {
        $this->dateNaisUser = $dateNaisUser;

        return $this;
    }

    public function getEmailUser(): ?string
    {
        return $this->emailUser;
    }

    public function setEmailUser(string $emailUser): static
    {
        $this->emailUser = $emailUser;

        return $this;
    }

    public function getDateEmbauche(): ?\DateTimeInterface
    {
        return $this->dateEmbauche;
    }

    public function setDateEmbauche(?\DateTimeInterface $dateEmbauche): static
    {
        $this->dateEmbauche = $dateEmbauche;

        return $this;
    }

    public function getDureeContrat(): ?int
    {
        return $this->dureeContrat;
    }

    public function setDureeContrat(?int $dureeContrat): static
    {
        $this->dureeContrat = $dureeContrat;

        return $this;
    }

    public function getDateVisiteur(): ?\DateTimeInterface
    {
        return $this->dateVisiteur;
    }

    public function setDateVisiteur(?\DateTimeInterface $dateVisiteur): static
    {
        $this->dateVisiteur = $dateVisiteur;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }
}
