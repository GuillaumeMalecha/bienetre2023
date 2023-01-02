<?php

namespace App\Entity;

use App\Repository\CommentaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentaireRepository::class)
 */
class Commentaire
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
    private $contenu;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cote;

    /**
     * @ORM\Column(type="date")
     */
    private $encodage;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\OneToMany(targetEntity=Prestataire::class, mappedBy="concerner")
     */
    private $prestataires;

    /**
     * @ORM\OneToMany(targetEntity=Internaute::class, mappedBy="commentaire")
     */
    private $rediger;

    /**
     * @ORM\ManyToOne(targetEntity=Abus::class, inversedBy="commentaires")
     */
    private $concerner;

    public function __construct()
    {
        $this->prestataires = new ArrayCollection();
        $this->rediger = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getCote(): ?int
    {
        return $this->cote;
    }

    public function setCote(?int $cote): self
    {
        $this->cote = $cote;

        return $this;
    }

    public function getEncodage(): ?\DateTimeInterface
    {
        return $this->encodage;
    }

    public function setEncodage(\DateTimeInterface $encodage): self
    {
        $this->encodage = $encodage;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

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
            $prestataire->setConcerner($this);
        }

        return $this;
    }

    public function removePrestataire(Prestataire $prestataire): self
    {
        if ($this->prestataires->removeElement($prestataire)) {
            // set the owning side to null (unless already changed)
            if ($prestataire->getConcerner() === $this) {
                $prestataire->setConcerner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Internaute>
     */
    public function getRediger(): Collection
    {
        return $this->rediger;
    }

    public function addRediger(Internaute $rediger): self
    {
        if (!$this->rediger->contains($rediger)) {
            $this->rediger[] = $rediger;
            $rediger->setCommentaire($this);
        }

        return $this;
    }

    public function removeRediger(Internaute $rediger): self
    {
        if ($this->rediger->removeElement($rediger)) {
            // set the owning side to null (unless already changed)
            if ($rediger->getCommentaire() === $this) {
                $rediger->setCommentaire(null);
            }
        }

        return $this;
    }

    public function getConcerner(): ?Abus
    {
        return $this->concerner;
    }

    public function setConcerner(?Abus $concerner): self
    {
        $this->concerner = $concerner;

        return $this;
    }
}
