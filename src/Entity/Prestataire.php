<?php

namespace App\Entity;

use App\Repository\PrestataireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PrestataireRepository::class)
 */
class Prestataire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $emailcontact;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numtel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numtva;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $siteinternet;

    /**
     * @ORM\ManyToOne(targetEntity=Images::class, inversedBy="logo")
     */
    private $images;

    /**
     * @ORM\OneToOne(targetEntity=Utilisateur::class, inversedBy="prestataire", cascade={"persist", "remove"})
     */
    private $profil;

    /**
     * @ORM\ManyToOne(targetEntity=Images::class, inversedBy="prestataires")
     */
    private $photo;

    /**
     * @ORM\ManyToMany(targetEntity=CategorieServices::class, inversedBy="prestataires")
     */
    private $proposer;

    /**
     * @ORM\ManyToOne(targetEntity=Stage::class, inversedBy="prestataires")
     */
    private $organiser;

    /**
     * @ORM\ManyToOne(targetEntity=Promotion::class, inversedBy="prestataires")
     */
    private $offrir;

    /**
     * @ORM\ManyToMany(targetEntity=Internaute::class, inversedBy="prestataires")
     */
    private $favori;

    /**
     * @ORM\ManyToOne(targetEntity=Commentaire::class, inversedBy="prestataires")
     */
    private $concerner;

    public function __construct()
    {
        $this->proposer = new ArrayCollection();
        $this->favori = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmailcontact(): ?string
    {
        return $this->emailcontact;
    }

    public function setEmailcontact(string $emailcontact): self
    {
        $this->emailcontact = $emailcontact;

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

    public function getNumtel(): ?string
    {
        return $this->numtel;
    }

    public function setNumtel(string $numtel): self
    {
        $this->numtel = $numtel;

        return $this;
    }

    public function getNumtva(): ?string
    {
        return $this->numtva;
    }

    public function setNumtva(string $numtva): self
    {
        $this->numtva = $numtva;

        return $this;
    }

    public function getSiteinternet(): ?string
    {
        return $this->siteinternet;
    }

    public function setSiteinternet(string $siteinternet): self
    {
        $this->siteinternet = $siteinternet;

        return $this;
    }

    public function getImages(): ?Images
    {
        return $this->images;
    }

    public function setImages(?Images $images): self
    {
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

    public function getPhoto(): ?Images
    {
        return $this->photo;
    }

    public function setPhoto(?Images $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return Collection<int, CategorieServices>
     */
    public function getProposer(): Collection
    {
        return $this->proposer;
    }

    public function addProposer(CategorieServices $proposer): self
    {
        if (!$this->proposer->contains($proposer)) {
            $this->proposer[] = $proposer;
        }

        return $this;
    }

    public function removeProposer(CategorieServices $proposer): self
    {
        $this->proposer->removeElement($proposer);

        return $this;
    }

    public function getOrganiser(): ?Stage
    {
        return $this->organiser;
    }

    public function setOrganiser(?Stage $organiser): self
    {
        $this->organiser = $organiser;

        return $this;
    }

    public function getOffrir(): ?Promotion
    {
        return $this->offrir;
    }

    public function setOffrir(?Promotion $offrir): self
    {
        $this->offrir = $offrir;

        return $this;
    }

    /**
     * @return Collection<int, Internaute>
     */
    public function getFavori(): Collection
    {
        return $this->favori;
    }

    public function addFavori(Internaute $favori): self
    {
        if (!$this->favori->contains($favori)) {
            $this->favori[] = $favori;
        }

        return $this;
    }

    public function removeFavori(Internaute $favori): self
    {
        $this->favori->removeElement($favori);

        return $this;
    }

    public function getConcerner(): ?Commentaire
    {
        return $this->concerner;
    }

    public function setConcerner(?Commentaire $concerner): self
    {
        $this->concerner = $concerner;

        return $this;
    }
}
