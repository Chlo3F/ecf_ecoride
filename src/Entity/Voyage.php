<?php

namespace App\Entity;

use App\Repository\VoyageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoyageRepository::class)]
class Voyage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'voyages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Chauffeur $chauffeur = null;

    #[ORM\Column(length: 50)]
    private ?string $idVilleDepart = null;

    #[ORM\Column(length: 50)]
    private ?string $IdVilleArrivee = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateHeureDepart = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateHeureArrivee = null;

    #[ORM\Column]
    private ?int $prix = null;

    #[ORM\Column]
    private ?int $nbPlaces = null;

    #[ORM\Column]
    private ?bool $ecologique = null;

    /**
     * @var Collection<int, Ville>
     */
    #[ORM\ManyToMany(targetEntity: Ville::class, inversedBy: 'voyages')]
    private Collection $villes;

    /**
     * @var Collection<int, Reservation>
     */
    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'voyage')]
    private Collection $reservations;

    public function __construct()
    {
        $this->villes = new ArrayCollection();
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIdVilleDepart(): ?string
    {
        return $this->idVilleDepart;
    }

    public function setIdVilleDepart(string $idVilleDepart): static
    {
        $this->idVilleDepart = $idVilleDepart;

        return $this;
    }

    public function getIdVilleArrivee(): ?string
    {
        return $this->IdVilleArrivee;
    }

    public function setIdVilleArrivee(string $IdVilleArrivee): static
    {
        $this->IdVilleArrivee = $IdVilleArrivee;

        return $this;
    }

    public function getDateHeureDepart(): ?\DateTimeInterface
    {
        return $this->dateHeureDepart;
    }

    public function setDateHeureDepart(\DateTimeInterface $dateHeureDepart): static
    {
        $this->dateHeureDepart = $dateHeureDepart;

        return $this;
    }

    public function getDateHeureArrivee(): ?\DateTimeInterface
    {
        return $this->dateHeureArrivee;
    }

    public function setDateHeureArrivee(\DateTimeInterface $dateHeureArrivee): static
    {
        $this->dateHeureArrivee = $dateHeureArrivee;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getNbPlaces(): ?int
    {
        return $this->nbPlaces;
    }

    public function setNbPlaces(int $nbPlaces): static
    {
        $this->nbPlaces = $nbPlaces;

        return $this;
    }

    public function isEcologique(): ?bool
    {
        return $this->ecologique;
    }

    public function setEcologique(bool $ecologique): static
    {
        $this->ecologique = $ecologique;

        return $this;
    }

    /**
     * @return Collection<int, Ville>
     */
    public function getVilles(): Collection
    {
        return $this->villes;
    }

    public function addVille(Ville $ville): static
    {
        if (!$this->villes->contains($ville)) {
            $this->villes->add($ville);
        }

        return $this;
    }

    public function removeVille(Ville $ville): static
    {
        $this->villes->removeElement($ville);

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setVoyage($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getVoyage() === $this) {
                $reservation->setVoyage(null);
            }
        }

        return $this;
    }
}
