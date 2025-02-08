<?php

namespace App\Entity;

use App\Repository\AvisRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AvisRepository::class)]
class Avis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'avis')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Passager $passager = null;

    #[ORM\Column]
    private ?int $note = null;

    #[ORM\Column(type: 'text')]
    #[Assert\Length(max: 500)] // Limite à 1000 caractères, (Validation par Symfony et non BDD)
    private ?string $commentaire = null;

    #[ORM\Column]
    private ?int $IdEmploye = null;

    #[ORM\Column]
    private ?bool $valide = null;

    #[ORM\ManyToOne(inversedBy: 'avis')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Chauffeur $chauffeur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPassager(): ?Passager
    {
        return $this->passager;
    }

    public function setPassager(?Passager $passager): static
    {
        $this->passager = $passager;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getIdEmploye(): ?int
    {
        return $this->IdEmploye;
    }

    public function setIdEmploye(int $IdEmploye): static
    {
        $this->IdEmploye = $IdEmploye;

        return $this;
    }

    public function isValide(): ?bool
    {
        return $this->valide;
    }

    public function setValide(bool $valide): static
    {
        $this->valide = $valide;

        return $this;
    }

    public function getChauffeur(): ?Chauffeur
    {
        return $this->chauffeur;
    }

    public function setChauffeur(?Chauffeur $chauffeur): static
    {
        $this->chauffeur = $chauffeur;

        return $this;
    }
}
