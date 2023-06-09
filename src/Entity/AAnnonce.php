<?php

namespace App\Entity;

use App\Repository\AAnnonceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: AAnnonceRepository::class)]
class AAnnonce
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:"le champ Prix est vide, il doit etre rempli.")]
    private ?float $aprix = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"le champ Ville est vide, il doit etre rempli.")]
    private ?string $aville = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"le champ Rue est vide, il doit etre rempli.")]
    private ?string $arue = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:"le champ de Numero d'immeuble est vide, il doit etre rempli.")]
    private ?int $anumimmo = null;

    #[ORM\Column(length: 255)]
    private ?string $aetat = null;

    #[ORM\Column(length: 255)]
    private ?string $atraite = null;

    #[ORM\ManyToOne(inversedBy: 'pannonces')]
    #[ORM\JoinColumn(nullable: false)]
    private ?AProprietaire $aproprietaire = null;

    #[ORM\OneToMany(mappedBy: 'iannonce', targetEntity: AImage::class, cascade: array('persist','remove'))]
    #[Assert\NotBlank(message:"le champ de l'image est vide, il doit etre rempli.")]
    private Collection $aImages;

    #[ORM\ManyToOne(inversedBy: 'cannonces')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank(message:"le champ Category est vide, il doit etre rempli.")]
    private ?ACategory $acategory = null;

    #[ORM\OneToMany(mappedBy: 'rannonce', targetEntity: AReservation::class)]
    private Collection $aReservations;

    #[ORM\Column]
    #[Assert\NotBlank(message:"le champ Bedrooms est vide, il doit etre rempli.")]
    private ?int $bedrooms = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:"le champ bathrooms est vide, il doit etre rempli.")]
    private ?int $bathrooms = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:"le champ Surface est vide, il doit etre rempli.")]
    private ?int $Surface = null;

    public function __construct()
    {
        $this->aImages = new ArrayCollection();
        $this->aReservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAprix(): ?float
    {
        return $this->aprix;
    }

    public function setAprix(float $aprix): self
    {
        $this->aprix = $aprix;

        return $this;
    }

    public function getAville(): ?string
    {
        return $this->aville;
    }

    public function setAville(string $aville): self
    {
        $this->aville = $aville;

        return $this;
    }

    public function getArue(): ?string
    {
        return $this->arue;
    }

    public function setArue(string $arue): self
    {
        $this->arue = $arue;

        return $this;
    }

    public function getAnumimmo(): ?int
    {
        return $this->anumimmo;
    }

    public function setAnumimmo(int $anumimmo): self
    {
        $this->anumimmo = $anumimmo;

        return $this;
    }

    public function getAetat(): ?string
    {
        return $this->aetat;
    }

    public function setAetat(string $aetat): self
    {
        $this->aetat = $aetat;

        return $this;
    }

    public function getAtraite(): ?string
    {
        return $this->atraite;
    }

    public function setAtraite(string $atraite): self
    {
        $this->atraite = $atraite;

        return $this;
    }

    public function getAproprietaire(): ?AProprietaire
    {
        return $this->aproprietaire;
    }

    public function setAproprietaire(?AProprietaire $aproprietaire): self
    {
        $this->aproprietaire = $aproprietaire;

        return $this;
    }

    /**
     * @return Collection<int, AImage>
     */
    public function getAImages(): Collection
    {
        return $this->aImages;
    }

    public function addAImage(AImage $aImage): self
    {
        if (!$this->aImages->contains($aImage)) {
            $this->aImages->add($aImage);
            $aImage->setIannonce($this);
        }

        return $this;
    }
    public function removeAImage(AImage $aImage): self
    {
        if ($this->aImages->removeElement($aImage)) {
            // set the owning side to null (unless already changed)
            if ($aImage->getIannonce() === $this) {
                $aImage->setIannonce(null);
            }
        }

        return $this;
    }

    public function getAcategory(): ?ACategory
    {
        return $this->acategory;
    }

    public function setAcategory(?ACategory $acategory): self
    {
        $this->acategory = $acategory;

        return $this;
    }

    /**
     * @return Collection<int, AReservation>
     */
    public function getAReservations(): Collection
    {
        return $this->aReservations;
    }

    public function addAReservation(AReservation $aReservation): self
    {
        if (!$this->aReservations->contains($aReservation)) {
            $this->aReservations->add($aReservation);
            $aReservation->setRannonce($this);
        }

        return $this;
    }

    public function removeAReservation(AReservation $aReservation): self
    {
        if ($this->aReservations->removeElement($aReservation)) {
            // set the owning side to null (unless already changed)
            if ($aReservation->getRannonce() === $this) {
                $aReservation->setRannonce(null);
            }
        }

        return $this;
    }

    public function getBedrooms(): ?int
    {
        return $this->bedrooms;
    }

    public function setBedrooms(int $bedrooms): self
    {
        $this->bedrooms = $bedrooms;

        return $this;
    }

    public function getBathrooms(): ?int
    {
        return $this->bathrooms;
    }

    public function setBathrooms(int $bathrooms): self
    {
        $this->bathrooms = $bathrooms;

        return $this;
    }

    public function getSurface(): ?int
    {
        return $this->Surface;
    }

    public function setSurface(int $Surface): self
    {
        $this->Surface = $Surface;

        return $this;
    }
}
