<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 * @UniqueEntity(fields={"email"}, message="Il existe déjà un compte avec cette adresse email.")
 */
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adressenum;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresserue;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $banni;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $inscriptconf;

    /**
     * @ORM\Column(type="date")
     */
    private $inscription;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbessaisinfructueux;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typeutilisateur;

    /**
     * @ORM\ManyToOne(targetEntity=CodePostal::class, inversedBy="utilisateur")
     * @ORM\JoinColumn(nullable=true)
     */
    private $codepostal;

    /**
     * @ORM\ManyToOne(targetEntity=Localite::class, inversedBy="utilisateur")
     * @ORM\JoinColumn(nullable=true)
     */
    private $localite;

    /**
     * @ORM\ManyToOne(targetEntity=Commune::class, inversedBy="utilisateur")
     * @ORM\JoinColumn(nullable=true)
     */
    private $commune;

    /**
     * @ORM\OneToOne(targetEntity=Internaute::class, cascade={"persist", "remove"})
     */
    private $profil;

    /**
     * @ORM\OneToOne(targetEntity=Prestataire::class, mappedBy="profil", cascade={"persist", "remove"})
     */
    private $prestataire;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;
    private Prestataire $userProfile;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getAdressenum(): ?string
    {
        return $this->adressenum;
    }

    public function setAdressenum(string $adressenum): self
    {
        $this->adressenum = $adressenum;

        return $this;
    }

    public function getAdresserue(): ?string
    {
        return $this->adresserue;
    }

    public function setAdresserue(string $adresserue): self
    {
        $this->adresserue = $adresserue;

        return $this;
    }

    public function isBanni(): ?bool
    {
        return $this->banni;
    }

    public function setBanni(bool $banni): self
    {
        $this->banni = $banni;

        return $this;
    }

    public function isInscriptconf(): ?bool
    {
        return $this->inscriptconf;
    }

    public function setInscriptconf(bool $inscriptconf): self
    {
        $this->inscriptconf = $inscriptconf;

        return $this;
    }

    public function getInscription(): ?\DateTimeInterface
    {
        return $this->inscription;
    }

    public function setInscription(\DateTimeInterface $inscription): self
    {
        $this->inscription = $inscription;

        return $this;
    }

    public function getNbessaisinfructueux(): ?int
    {
        return $this->nbessaisinfructueux;
    }

    public function setNbessaisinfructueux(int $nbessaisinfructueux): self
    {
        $this->nbessaisinfructueux = $nbessaisinfructueux;

        return $this;
    }

    public function getTypeutilisateur(): ?string
    {
        return $this->typeutilisateur;
    }

    public function setTypeutilisateur(string $typeutilisateur): self
    {
        $this->typeutilisateur = $typeutilisateur;

        return $this;
    }

    public function getLocalite(): ?Localite
    {
        return $this->localite;
    }

    public function setLocalite(?Localite $localite): self
    {
        $this->localite = $localite;

        return $this;
    }

    public function getCommune(): ?Commune
    {
        return $this->commune;
    }

    public function setCommune(?Commune $commune): self
    {
        $this->commune = $commune;

        return $this;
    }


    public function getCodepostal(): ?CodePostal
    {
        return $this->codepostal;
    }

    public function setCodepostal(?CodePostal $codepostal): self
    {
        $this->codepostal = $codepostal;

        return $this;
    }



    public function getProfil(): ?Internaute
    {
        return $this->profil;
    }

    public function setProfil(?Internaute $profil): self
    {
        $this->profil = $profil;

        return $this;
    }

    public function getPrestataire(): ?Prestataire
    {
        return $this->prestataire;
    }

    public function setPrestataire(?Prestataire $prestataire): self
    {
        // unset the owning side of the relation if necessary
        if ($prestataire === null && $this->prestataire !== null) {
            $this->prestataire->setProfil(null);
        }

        // set the owning side of the relation if necessary
        if ($prestataire !== null && $prestataire->getProfil() !== $this) {
            $prestataire->setProfil($this);
        }

        $this->prestataire = $prestataire;

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }




}
