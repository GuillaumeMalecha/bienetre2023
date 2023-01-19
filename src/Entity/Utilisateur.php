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
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
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
     * @ORM\Column(type="string", length=255)
     */
    private $adressenum;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresserue;

    /**
     * @ORM\Column(type="boolean")
     */
    private $banni;

    /**
     * @ORM\Column(type="boolean")
     */
    private $inscriptconf;

    /**
     * @ORM\Column(type="date")
     */
    private $inscription;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbessaisinfructueux;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typeutilisateur;

    /**
     * @ORM\OneToMany(targetEntity=CodePostal::class, mappedBy="utilisateur")
     */
    private $adressecp;

    /**
     * @ORM\OneToMany(targetEntity=Localite::class, mappedBy="utilisateur")
     */
    private $adresselocalite;

    /**
     * @ORM\OneToMany(targetEntity=Commune::class, mappedBy="utilisateur")
     */
    private $adressecommune;

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

    public function __construct()
    {
        $this->adressecp = new ArrayCollection();
        $this->adresselocalite = new ArrayCollection();
        $this->adressecommune = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, CodePostal>
     */
    public function getAdressecp(): Collection
    {
        return $this->adressecp;
    }

    public function addAdressecp(CodePostal $adressecp): self
    {
        if (!$this->adressecp->contains($adressecp)) {
            $this->adressecp[] = $adressecp;
            $adressecp->setUtilisateur($this);
        }

        return $this;
    }

    public function removeAdressecp(CodePostal $adressecp): self
    {
        if ($this->adressecp->removeElement($adressecp)) {
            // set the owning side to null (unless already changed)
            if ($adressecp->getUtilisateur() === $this) {
                $adressecp->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Localite>
     */
    public function getAdresselocalite(): Collection
    {
        return $this->adresselocalite;
    }

    public function addAdresselocalite(Localite $adresselocalite): self
    {
        if (!$this->adresselocalite->contains($adresselocalite)) {
            $this->adresselocalite[] = $adresselocalite;
            $adresselocalite->setUtilisateur($this);
        }

        return $this;
    }

    public function removeAdresselocalite(Localite $adresselocalite): self
    {
        if ($this->adresselocalite->removeElement($adresselocalite)) {
            // set the owning side to null (unless already changed)
            if ($adresselocalite->getUtilisateur() === $this) {
                $adresselocalite->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Commune>
     */
    public function getAdressecommune(): Collection
    {
        return $this->adressecommune;
    }

    public function addAdressecommune(Commune $adressecommune): self
    {
        if (!$this->adressecommune->contains($adressecommune)) {
            $this->adressecommune[] = $adressecommune;
            $adressecommune->setUtilisateur($this);
        }

        return $this;
    }

    public function removeAdressecommune(Commune $adressecommune): self
    {
        if ($this->adressecommune->removeElement($adressecommune)) {
            // set the owning side to null (unless already changed)
            if ($adressecommune->getUtilisateur() === $this) {
                $adressecommune->setUtilisateur(null);
            }
        }

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
