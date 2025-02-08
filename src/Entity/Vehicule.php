<?php

namespace App\Entity;

use App\Repository\VehiculeRepository;
use App\Enum\TypeEnergie;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehiculeRepository::class)]
class Vehicule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $immatriculation = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datePremiereImmatriculation = null;

    #[ORM\Column(length: 50)]
    private ?string $marqueVoiture = null;

    #[ORM\Column(length: 50)]
    private ?string $modeleVoiture = null;

    #[ORM\Column(length: 20)]
    private ?string $couleur = null;

    #[ORM\Column(type: Types::SIMPLE_ARRAY, enumType: TypeEnergie::class)]
    private array $TypeEnergie = [];

    #[ORM\ManyToOne(inversedBy: 'vehicules')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Chauffeur $Chauffeur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImmatriculation(): ?string
    {
        return $this->immatriculation;
    }

    public function setImmatriculation(string $immatriculation): static
    {
        $this->immatriculation = $immatriculation;

        return $this;
    }

    public function getDatePremiereImmatriculation(): ?\DateTimeInterface
    {
        return $this->datePremiereImmatriculation;
    }

    public function setDatePremiereImmatriculation(\DateTimeInterface $datePremiereImmatriculation): static
    {
        $this->datePremiereImmatriculation = $datePremiereImmatriculation;

        return $this;
    }

    public function getMarqueVoiture(): ?string
    {
        return $this->marqueVoiture;
    }

    public function setMarqueVoiture(string $marqueVoiture): static
    {
        $this->marqueVoiture = $marqueVoiture;

        return $this;
    }

    public function getModeleVoiture(): ?string
    {
        return $this->modeleVoiture;
    }

    public function setModeleVoiture(string $modeleVoiture): static
    {
        $this->modeleVoiture = $modeleVoiture;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): static
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * @return TypeEnergie[]
     */
    public function getTypeEnergie(): array
    {
        return $this->TypeEnergie;
    }

    public function setTypeEnergie(array $TypeEnergie): static
    {
        $this->TypeEnergie = $TypeEnergie;

        return $this;
    }

    public function getChauffeur(): ?Chauffeur
    {
        return $this->Chauffeur;
    }

    public function setChauffeur(?Chauffeur $Chauffeur): static
    {
        $this->Chauffeur = $Chauffeur;

        return $this;
    }
}
