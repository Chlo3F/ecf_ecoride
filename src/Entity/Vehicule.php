<?php

namespace App\Entity;

use App\Repository\VehiculeRepository;
use App\Enum\TypeEnergie;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: VehiculeRepository::class)]
class Vehicule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: "/^([A-Z]{2}-\d{3}-[A-Z]{2}|\d{1,4} [A-Z]{2} \d{2})$/",
        message: "Le format de la plaque d'immatriculation est invalide (ex: AB-123-CD ou 1234 AB 56)."
    )]
      private ?string $immatriculation = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank]
    private ?\DateTimeInterface $datePremiereImmatriculation = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank]
    private ?string $marqueVoiture = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank]
    private ?string $modeleVoiture = null;

    #[ORM\Column(length: 20)]
    #[Assert\NotBlank]
    private ?string $couleur = null;

    #[ORM\Column(type: Types::SIMPLE_ARRAY, enumType: TypeEnergie::class)]
    private array $TypeEnergie = [];

    #[ORM\ManyToOne(inversedBy: 'vehicules')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Chauffeur $chauffeur = null;

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
        return $this->chauffeur;
    }

    public function setChauffeur(?Chauffeur $chauffeur): static
    {
        $this->chauffeur = $chauffeur;

        return $this;
    }
}
