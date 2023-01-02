<?php

namespace App\Entity;

use App\Repository\ImagesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImagesRepository::class)
 */
class Images
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
    private $image;

    /**
     * @ORM\Column(type="integer")
     */
    private $ordre;

    /**
     * @ORM\OneToOne(targetEntity=CategorieServices::class, inversedBy="images", cascade={"persist", "remove"})
     */
    private $photo;

    /**
     * @ORM\OneToMany(targetEntity=Prestataire::class, mappedBy="images")
     */
    private $logo;

    /**
     * @ORM\OneToOne(targetEntity=Internaute::class, inversedBy="images", cascade={"persist", "remove"})
     */
    private $avatar;

    /**
     * @ORM\OneToMany(targetEntity=Prestataire::class, mappedBy="photo")
     */
    private $prestataires;

    public function __construct()
    {
        $this->logo = new ArrayCollection();
        $this->prestataires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getOrdre(): ?int
    {
        return $this->ordre;
    }

    public function setOrdre(int $ordre): self
    {
        $this->ordre = $ordre;

        return $this;
    }

    public function getPhoto(): ?CategorieServices
    {
        return $this->photo;
    }

    public function setPhoto(?CategorieServices $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return Collection<int, Prestataire>
     */
    public function getLogo(): Collection
    {
        return $this->logo;
    }

    public function addLogo(Prestataire $logo): self
    {
        if (!$this->logo->contains($logo)) {
            $this->logo[] = $logo;
            $logo->setImages($this);
        }

        return $this;
    }

    public function removeLogo(Prestataire $logo): self
    {
        if ($this->logo->removeElement($logo)) {
            // set the owning side to null (unless already changed)
            if ($logo->getImages() === $this) {
                $logo->setImages(null);
            }
        }

        return $this;
    }

    public function getAvatar(): ?Internaute
    {
        return $this->avatar;
    }

    public function setAvatar(?Internaute $avatar): self
    {
        $this->avatar = $avatar;

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
            $prestataire->setPhoto($this);
        }

        return $this;
    }

    public function removePrestataire(Prestataire $prestataire): self
    {
        if ($this->prestataires->removeElement($prestataire)) {
            // set the owning side to null (unless already changed)
            if ($prestataire->getPhoto() === $this) {
                $prestataire->setPhoto(null);
            }
        }

        return $this;
    }
}
