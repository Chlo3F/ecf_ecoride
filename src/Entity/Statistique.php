<?php

namespace App\Entity;

use App\Repository\StatistiqueRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatistiqueRepository::class)]
class Statistique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    private ?int $nbVoyage = null;

    #[ORM\Column]
    private ?int $revenus = null;

    #[ORM\ManyToOne(inversedBy: 'statistiques')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Administrateur $administrateur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getNbVoyage(): ?int
    {
        return $this->nbVoyage;
    }

    public function setNbVoyage(int $nbVoyage): static
    {
        $this->nbVoyage = $nbVoyage;

        return $this;
    }

    public function getRevenus(): ?int
    {
        return $this->revenus;
    }

    public function setRevenus(int $revenus): static
    {
        $this->revenus = $revenus;

        return $this;
    }

    public function getAdministrateur(): ?Administrateur
    {
        return $this->administrateur;
    }

    public function setAdministrateur(?Administrateur $administrateur): static
    {
        $this->administrateur = $administrateur;

        return $this;
    }
}
