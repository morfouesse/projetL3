<?php

namespace App\Entity;

use App\Repository\LogementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LogementRepository::class)
 */
class Logement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomLogement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomTypeLogement;

    /**
     * @ORM\Column(type="float")
     */
    private $prixLogement;

    /**
     * @ORM\OneToMany(targetEntity=OffreReservation::class, mappedBy="uneReservationDunLogement")
     */
    private $lesOffresdeReservationDunLogement;

    /**
     * @ORM\OneToMany(targetEntity=Photo::class, mappedBy="unePhotoDunLogement")
     */
    private $lesPhotosDunLogement;

   
    /**
     * @ORM\ManyToOne(targetEntity=Ville::class, inversedBy="lesLogementsDuneVille")
     * @ORM\JoinColumn(nullable=false)
     */
    private $laVilleDunLogement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descriptionLogement;

    /**
     * @ORM\OneToMany(targetEntity=EquipementDunLogement::class, mappedBy="leLogement")
     */
    private $equipementDunLogements;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="leCommentaireDuLogement")
     */
    private $lesCommentairesDunLogement;

  

    public function __construct()
    {
        $this->lesOffresdeReservationDunLogement = new ArrayCollection();
        $this->lesPhotosDunLogement = new ArrayCollection();
        $this->equipementDunLogements = new ArrayCollection();
        $this->lesCommentairesDunLogement = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomLogement(): ?string
    {
        return $this->nomLogement;
    }

    public function setNomLogement(string $nomLogement): self
    {
        $this->nomLogement = $nomLogement;

        return $this;
    }

    public function getNomTypeLogement(): ?string
    {
        return $this->nomTypeLogement;
    }

    public function setNomTypeLogement(string $nomTypeLogement): self
    {
        $this->nomTypeLogement = $nomTypeLogement;

        return $this;
    }

    public function getPrixLogement(): ?float
    {
        return $this->prixLogement;
    }

    public function setPrixLogement(float $prixLogement): self
    {
        $this->prixLogement = $prixLogement;

        return $this;
    }

    /**
     * @return Collection|OffreReservation[]
     */
    public function getLesOffresdeReservationDunLogement(): Collection
    {
        return $this->lesOffresdeReservationDunLogement;
    }

    public function addLesOffresdeReservationDunLogement(OffreReservation $lesOffresdeReservationDunLogement): self
    {
        if (!$this->lesOffresdeReservationDunLogement->contains($lesOffresdeReservationDunLogement)) {
            $this->lesOffresdeReservationDunLogement[] = $lesOffresdeReservationDunLogement;
            $lesOffresdeReservationDunLogement->setUneReservationDunLogement($this);
        }

        return $this;
    }

    public function removeLesOffresdeReservationDunLogement(OffreReservation $lesOffresdeReservationDunLogement): self
    {
        if ($this->lesOffresdeReservationDunLogement->contains($lesOffresdeReservationDunLogement)) {
            $this->lesOffresdeReservationDunLogement->removeElement($lesOffresdeReservationDunLogement);
            // set the owning side to null (unless already changed)
            if ($lesOffresdeReservationDunLogement->getUneReservationDunLogement() === $this) {
                $lesOffresdeReservationDunLogement->setUneReservationDunLogement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Photo[]
     */
    public function getLesPhotosDunLogement(): Collection
    {
        return $this->lesPhotosDunLogement;
    }

    public function addLesPhotosDunLogement(Photo $lesPhotosDunLogement): self
    {
        if (!$this->lesPhotosDunLogement->contains($lesPhotosDunLogement)) {
            $this->lesPhotosDunLogement[] = $lesPhotosDunLogement;
            $lesPhotosDunLogement->setUnePhotoDunLogement($this);
        }

        return $this;
    }

    public function removeLesPhotosDunLogement(Photo $lesPhotosDunLogement): self
    {
        if ($this->lesPhotosDunLogement->contains($lesPhotosDunLogement)) {
            $this->lesPhotosDunLogement->removeElement($lesPhotosDunLogement);
            // set the owning side to null (unless already changed)
            if ($lesPhotosDunLogement->getUnePhotoDunLogement() === $this) {
                $lesPhotosDunLogement->setUnePhotoDunLogement(null);
            }
        }

        return $this;
    }

  

    public function getLaVilleDunLogement(): ?Ville
    {
        return $this->laVilleDunLogement;
    }

    public function setLaVilleDunLogement(?Ville $laVilleDunLogement): self
    {
        $this->laVilleDunLogement = $laVilleDunLogement;

        return $this;
    }

    public function getDescriptionLogement(): ?string
    {
        return $this->descriptionLogement;
    }

    public function setDescriptionLogement(string $descriptionLogement): self
    {
        $this->descriptionLogement = $descriptionLogement;

        return $this;
    }

    /**
     * @return Collection|EquipementDunLogement[]
     */
    public function getEquipementDunLogements(): Collection
    {
        return $this->equipementDunLogements;
    }

    public function addEquipementDunLogement(EquipementDunLogement $equipementDunLogement): self
    {
        if (!$this->equipementDunLogements->contains($equipementDunLogement)) {
            $this->equipementDunLogements[] = $equipementDunLogement;
            $equipementDunLogement->setLeLogement($this);
        }

        return $this;
    }

    public function removeEquipementDunLogement(EquipementDunLogement $equipementDunLogement): self
    {
        if ($this->equipementDunLogements->contains($equipementDunLogement)) {
            $this->equipementDunLogements->removeElement($equipementDunLogement);
            // set the owning side to null (unless already changed)
            if ($equipementDunLogement->getLeLogement() === $this) {
                $equipementDunLogement->setLeLogement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Commentaire[]
     */
    public function getLesCommentairesDunLogement(): Collection
    {
        return $this->lesCommentairesDunLogement;
    }

    public function addLesCommentairesDunLogement(Commentaire $lesCommentairesDunLogement): self
    {
        if (!$this->lesCommentairesDunLogement->contains($lesCommentairesDunLogement)) {
            $this->lesCommentairesDunLogement[] = $lesCommentairesDunLogement;
            $lesCommentairesDunLogement->setLeCommentaireDuLogement($this);
        }

        return $this;
    }

    public function removeLesCommentairesDunLogement(Commentaire $lesCommentairesDunLogement): self
    {
        if ($this->lesCommentairesDunLogement->contains($lesCommentairesDunLogement)) {
            $this->lesCommentairesDunLogement->removeElement($lesCommentairesDunLogement);
            // set the owning side to null (unless already changed)
            if ($lesCommentairesDunLogement->getLeCommentaireDuLogement() === $this) {
                $lesCommentairesDunLogement->setLeCommentaireDuLogement(null);
            }
        }

        return $this;
    }

  
}
