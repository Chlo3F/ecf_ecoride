<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'Il y a déjà un compte avec cet email')]
class Utilisateur implements  UserInterface, PasswordAuthenticatedUserInterface

{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 50)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank]
    private ?string $email = null;

    #[ORM\Column]
    private ?int $credits = null;


    #[ORM\Column(type: 'json')]
    private array $roles = [];



    #[ORM\OneToOne(mappedBy: 'utilisateur', cascade: ['persist', 'remove'])]
    private ?Chauffeur $chauffeur = null;

    #[ORM\OneToOne(mappedBy: 'utilisateur', cascade: ['persist', 'remove'])]
    private ?Employe $employe = null;

    #[ORM\OneToOne(mappedBy: 'utilisateur', cascade: ['persist', 'remove'])]
    private ?Administrateur $administrateur = null;

    #[ORM\OneToOne(mappedBy: 'utilisateur', cascade: ['persist', 'remove'])]
    private ?Passager $passager = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }


    public function getCredits(): ?int
    {
        return $this->credits;
    }

    public function setCredits(int $credits): static
    {
        $this->credits = $credits;

        return $this;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function eraseCredentials(): void
    {
        // Nettoyage des données sensibles (si nécessaire)
    }
    

    

    public function getChauffeur(): ?Chauffeur
    {
        return $this->chauffeur;
    }

    public function setChauffeur(Chauffeur $chauffeur): static
    {
        $this->chauffeur = $chauffeur;

        // Associer automatiquement l'utilisateur au chauffeur
        if ($chauffeur !== null && $chauffeur->getUtilisateur() !== $this) {
            $chauffeur->setUtilisateur($this);
    }

        return $this;
    }

    public function getEmploye(): ?Employe
    {
        return $this->employe;
    }

    public function setEmploye(Employe $employe): static
    {
        // set the owning side of the relation if necessary
        if ($employe->getUtilisateur() !== $this) {
            $employe->setUtilisateur($this);
        }

        $this->employe = $employe;

        return $this;
    }

    public function getAdministrateur(): ?Administrateur
    {
        return $this->administrateur;
    }

    public function setAdministrateur(Administrateur $administrateur): static
    {
        // set the owning side of the relation if necessary
        if ($administrateur->getUtilisateur() !== $this) {
            $administrateur->setUtilisateur($this);
        }

        $this->administrateur = $administrateur;

        return $this;
    }

    public function getPassager(): ?Passager
{
    return $this->passager;
}

public function setPassager(?Passager $passager): static
{
    $this->passager = $passager;
    if ($passager !== null && $passager->getUtilisateur() !== $this) {
        $passager->setUtilisateur($this);
    }
    return $this;
}

   
}