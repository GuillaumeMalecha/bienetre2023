<?php

namespace App\Entity;

use App\Repository\BlocRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BlocRepository::class)
 */
class Bloc
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
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\ManyToMany(targetEntity=Internaute::class, inversedBy="blocs")
     */
    private $choix;

    public function __construct()
    {
        $this->choix = new ArrayCollection();
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
     * @return Collection<int, Internaute>
     */
    public function getChoix(): Collection
    {
        return $this->choix;
    }

    public function addChoix(Internaute $choix): self
    {
        if (!$this->choix->contains($choix)) {
            $this->choix[] = $choix;
        }

        return $this;
    }

    public function removeChoix(Internaute $choix): self
    {
        $this->choix->removeElement($choix);

        return $this;
    }
}
