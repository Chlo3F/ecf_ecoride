<?php

namespace App\Entity;

use App\Repository\PreferenceRepository;
use App\Enum\TypePreference;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: PreferenceRepository::class)]
class Preference
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::SIMPLE_ARRAY, enumType: TypePreference::class)]
    private array $TypePreference = [];

    /**
     * @var Collection<int, Chauffeur>
     */
    #[ORM\OneToMany(targetEntity: Chauffeur::class, mappedBy: 'preference')]
    private Collection $Chauffeur;

    #[ORM\Column]
    private ?bool $valeurBoolean = null;

    #[ORM\Column(length: 100)]
    private ?string $valeurPersonnalise = null;

    public function __construct()
    {
        $this->Chauffeur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return TypePreference[]
     */
    public function getTypePreference(): array
    {
        return $this->TypePreference;
    }

    public function setTypePreference(array $TypePreference): static
    {
        $this->TypePreference = $TypePreference;

        return $this;
    }

    /**
     * @return Collection<int, Chauffeur>
     */
    public function getChauffeur(): Collection
    {
        return $this->Chauffeur;
    }

    public function addChauffeur(Chauffeur $chauffeur): static
    {
        if (!$this->Chauffeur->contains($chauffeur)) {
            $this->Chauffeur->add($chauffeur);
            $chauffeur->setPreference($this);
        }

        return $this;
    }

    public function removeChauffeur(Chauffeur $chauffeur): static
    {
        if ($this->Chauffeur->removeElement($chauffeur)) {
            // set the owning side to null (unless already changed)
            if ($chauffeur->getPreference() === $this) {
                $chauffeur->setPreference(null);
            }
        }

        return $this;
    }

    public function isValeurBoolean(): ?bool
    {
        return $this->valeurBoolean;
    }

    public function setValeurBoolean(bool $valeurBoolean): static
    {
        $this->valeurBoolean = $valeurBoolean;

        return $this;
    }

    public function getValeurPersonnalise(): ?string
    {
        return $this->valeurPersonnalise;
    }

    public function setValeurPersonnalise(string $valeurPersonnalise): static
    {
        $this->valeurPersonnalise = $valeurPersonnalise;

        return $this;
    }
}
