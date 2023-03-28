<?php

namespace App\Entity;

use App\Repository\InternauteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InternauteRepository::class)
 */
class Internaute
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $newsletter;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\OneToOne(targetEntity=Images::class, mappedBy="avatar", cascade={"persist", "remove"})
     */
    private $images;

    /**
     * @ORM\OneToOne(targetEntity=Utilisateur::class, inversedBy="internaute", cascade={"persist", "remove"})
     */
    private $profil;

    /**
     * @ORM\ManyToMany(targetEntity=Bloc::class, mappedBy="choix")
     */
    private $blocs;

    /**
     * @ORM\ManyToMany(targetEntity=Prestataire::class, mappedBy="favori")
     */
    private $prestataires;

    /**
     * @ORM\ManyToOne(targetEntity=Commentaire::class, inversedBy="rediger")
     */
    private $commentaire;

    /**
     * @ORM\ManyToOne(targetEntity=Abus::class, inversedBy="prevenir")
     */
    private $abus;

    public function __construct()
    {
        $this->blocs = new ArrayCollection();
        $this->prestataires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isNewsletter(): ?bool
    {
        return $this->newsletter;
    }

    public function setNewsletter(bool $newsletter): self
    {
        $this->newsletter = $newsletter;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getImages(): ?Images
    {
        return $this->images;
    }

    public function setImages(?Images $images): self
    {
        // unset the owning side of the relation if necessary
        if ($images === null && $this->images !== null) {
            $this->images->setAvatar(null);
        }

        // set the owning side of the relation if necessary
        if ($images !== null && $images->getAvatar() !== $this) {
            $images->setAvatar($this);
        }

        $this->images = $images;

        return $this;
    }

    public function getProfil(): ?Utilisateur
    {
        return $this->profil;
    }

    public function setProfil(?Utilisateur $profil): self
    {
        $this->profil = $profil;

        return $this;
    }

    /**
     * @return Collection<int, Bloc>
     */
    public function getBlocs(): Collection
    {
        return $this->blocs;
    }

    public function addBloc(Bloc $bloc): self
    {
        if (!$this->blocs->contains($bloc)) {
            $this->blocs[] = $bloc;
            $bloc->addChoix($this);
        }

        return $this;
    }

    public function removeBloc(Bloc $bloc): self
    {
        if ($this->blocs->removeElement($bloc)) {
            $bloc->removeChoix($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Prestataire>
     */
    public function getPrestataires(): Collection
    {
        return $this->prestataires;
    }

    public function addPrestataire(Prestataire $prestataire): self
    {
        if (!$this->prestataires->contains($prestataire)) {
            $this->prestataires[] = $prestataire;
            $prestataire->addFavori($this);
        }

        return $this;
    }

    public function removePrestataire(Prestataire $prestataire): self
    {
        if ($this->prestataires->removeElement($prestataire)) {
            $prestataire->removeFavori($this);
        }

        return $this;
    }

    public function getCommentaire(): ?Commentaire
    {
        return $this->commentaire;
    }

    public function setCommentaire(?Commentaire $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getAbus(): ?Abus
    {
        return $this->abus;
    }

    public function setAbus(?Abus $abus): self
    {
        $this->abus = $abus;

        return $this;
    }
}
