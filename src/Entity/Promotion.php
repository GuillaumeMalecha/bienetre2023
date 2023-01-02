<?php

namespace App\Entity;

use App\Repository\PromotionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PromotionRepository::class)
 */
class Promotion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $affichagede;

    /**
     * @ORM\Column(type="date")
     */
    private $affichagejusque;

    /**
     * @ORM\Column(type="date")
     */
    private $debut;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $documentpdf;

    /**
     * @ORM\Column(type="date")
     */
    private $fin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Prestataire::class, mappedBy="offrir")
     */
    private $prestataires;

    /**
     * @ORM\OneToMany(targetEntity=CategorieServices::class, mappedBy="promotion")
     */
    private $concerner;

    public function __construct()
    {
        $this->prestataires = new ArrayCollection();
        $this->concerner = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAffichagede(): ?\DateTimeInterface
    {
        return $this->affichagede;
    }

    public function setAffichagede(\DateTimeInterface $affichagede): self
    {
        $this->affichagede = $affichagede;

        return $this;
    }

    public function getAffichagejusque(): ?\DateTimeInterface
    {
        return $this->affichagejusque;
    }

    public function setAffichagejusque(\DateTimeInterface $affichagejusque): self
    {
        $this->affichagejusque = $affichagejusque;

        return $this;
    }

    public function getDebut(): ?\DateTimeInterface
    {
        return $this->debut;
    }

    public function setDebut(\DateTimeInterface $debut): self
    {
        $this->debut = $debut;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDocumentpdf(): ?string
    {
        return $this->documentpdf;
    }

    public function setDocumentpdf(string $documentpdf): self
    {
        $this->documentpdf = $documentpdf;

        return $this;
    }

    public function getFin(): ?\DateTimeInterface
    {
        return $this->fin;
    }

    public function setFin(\DateTimeInterface $fin): self
    {
        $this->fin = $fin;

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
            $prestataire->setOffrir($this);
        }

        return $this;
    }

    public function removePrestataire(Prestataire $prestataire): self
    {
        if ($this->prestataires->removeElement($prestataire)) {
            // set the owning side to null (unless already changed)
            if ($prestataire->getOffrir() === $this) {
                $prestataire->setOffrir(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CategorieServices>
     */
    public function getConcerner(): Collection
    {
        return $this->concerner;
    }

    public function addConcerner(CategorieServices $concerner): self
    {
        if (!$this->concerner->contains($concerner)) {
            $this->concerner[] = $concerner;
            $concerner->setPromotion($this);
        }

        return $this;
    }

    public function removeConcerner(CategorieServices $concerner): self
    {
        if ($this->concerner->removeElement($concerner)) {
            // set the owning side to null (unless already changed)
            if ($concerner->getPromotion() === $this) {
                $concerner->setPromotion(null);
            }
        }

        return $this;
    }
}
