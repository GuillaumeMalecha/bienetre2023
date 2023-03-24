<?php

namespace App\Entity;

use App\Repository\CodePostalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CodePostalRepository::class)
 */
class CodePostal
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
    private $codepostal;

    /**
     * @ORM\OneToMany(targetEntity=Utilisateur::class, mappedBy="codePostal")
     */
    private $utilisateur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __construct()
    {
        $this->utilisateur = new ArrayCollection();
    }

    public function getCodePostal(): ?string
    {
        return $this->codepostal;
    }

    public function setCodePostal(string $codepostal): self
    {
        $this->codepostal = $codepostal;

        return $this;
    }

    public function getUtilisateur(): Collection
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }
}
