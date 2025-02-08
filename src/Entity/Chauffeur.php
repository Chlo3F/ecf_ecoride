<?php

namespace App\Entity;

use App\Repository\ChauffeurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChauffeurRepository::class)]
class Chauffeur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'chauffeur', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $utilisateur = null;

    /**
     * @var Collection<int, Vehicule>
     */
    #[ORM\OneToMany(targetEntity: Vehicule::class, mappedBy: 'chauffeur', orphanRemoval: true)]
    private Collection $vehicules;

    /**
     * @var Collection<int, Voyage>
     */
    #[ORM\OneToMany(targetEntity: Voyage::class, mappedBy: 'chauffeur', orphanRemoval: true)]
    private Collection $voyages;

    #[ORM\ManyToOne(inversedBy: 'chauffeur')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Preference $preference = null;

    /**
     * @var Collection<int, Avis>
     */
    #[ORM\OneToMany(targetEntity: Avis::class, mappedBy: 'chauffeur')]
    private Collection $avis;

    public function __construct()
    {
        $this->vehicules = new ArrayCollection();
        $this->voyages = new ArrayCollection();
        $this->avis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(Utilisateur $utilisateur): static
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * @return Collection<int, Vehicule>
     */
    public function getVehicules(): Collection
    {
        return $this->vehicules;
    }

    public function addVehicule(Vehicule $vehicule): static
    {
        if (!$this->vehicules->contains($vehicule)) {
            $this->vehicules->add($vehicule);
            $vehicule->setChauffeur($this);
        }

        return $this;
    }

    public function removeVehicule(Vehicule $vehicule): static
    {
        if ($this->vehicules->removeElement($vehicule)) {
            // set the owning side to null (unless already changed)
            if ($vehicule->getChauffeur() === $this) {
                $vehicule->setChauffeur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Voyage>
     */
    public function getIdVoyages(): Collection
    {
        return $this->voyages;
    }

    public function addvoyages(Voyage $voyages): static
    {
        if (!$this->voyages->contains($voyages)) {
            $this->voyages->add($voyages);
            $voyages->setChauffeur($this);
        }

        return $this;
    }

    public function removeVoyages(Voyage $voyages): static
    {
        if ($this->voyages->removeElement($voyages)) {
            // set the owning side to null (unless already changed)
            if ($voyages->getChauffeur() === $this) {
                $voyages->setChauffeur(null);
            }
        }

        return $this;
    }

    public function getPreference(): ?Preference
    {
        return $this->preference;
    }

    public function setPreference(?Preference $preference): static
    {
        $this->preference = $preference;

        return $this;
    }

    /**
     * @return Collection<int, Avis>
     */
    public function getAvis(): Collection
    {
        return $this->avis;
    }

    public function addAvi(Avis $avi): static
    {
        if (!$this->avis->contains($avi)) {
            $this->avis->add($avi);
            $avi->setChauffeur($this);
        }

        return $this;
    }

    public function removeAvi(Avis $avi): static
    {
        if ($this->avis->removeElement($avi)) {
            // set the owning side to null (unless already changed)
            if ($avi->getChauffeur() === $this) {
                $avi->setChauffeur(null);
            }
        }

        return $this;
    }
}
