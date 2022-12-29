<?php

namespace App\Entity;

use App\Repository\PromotionRepository;
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
}
