<?php

namespace App\Entity;

use App\Repository\AbusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AbusRepository::class)
 */
class Abus
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
    private $description;

    /**
     * @ORM\Column(type="date")
     */
    private $encodage;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="concerner")
     */
    private $commentaires;

    /**
     * @ORM\OneToMany(targetEntity=Internaute::class, mappedBy="abus")
     */
    private $prevenir;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
        $this->prevenir = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEncodage(): ?\DateTimeInterface
    {
        return $this->encodage;
    }

    public function setEncodage(\DateTimeInterface $encodage): self
    {
        $this->encodage = $encodage;

        return $this;
    }

    /**
     * @return Collection<int, Commentaire>
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setConcerner($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getConcerner() === $this) {
                $commentaire->setConcerner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Internaute>
     */
    public function getPrevenir(): Collection
    {
        return $this->prevenir;
    }

    public function addPrevenir(Internaute $prevenir): self
    {
        if (!$this->prevenir->contains($prevenir)) {
            $this->prevenir[] = $prevenir;
            $prevenir->setAbus($this);
        }

        return $this;
    }

    public function removePrevenir(Internaute $prevenir): self
    {
        if ($this->prevenir->removeElement($prevenir)) {
            // set the owning side to null (unless already changed)
            if ($prevenir->getAbus() === $this) {
                $prevenir->setAbus(null);
            }
        }

        return $this;
    }
}
