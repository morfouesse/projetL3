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
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titreCommentaire;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descriptionCommentaire;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $notationCommentaire;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="lesCommentairesDunUser")
     */
    private $leCommentaireDunUser;

    /**
     * @ORM\ManyToOne(targetEntity=Logement::class, inversedBy="lesCommentairesDunLogement")
     */
    private $leCommentaireDuLogement;

    /**
     * @ORM\OneToMany(targetEntity=OffreReservation::class, mappedBy="unCommentaireDuneOffre")
     */
    private $lesCommentairesDuneOffre;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $actif;


    public function __construct()
    {
        $this->lesCommentairesDuneOffre = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreCommentaire(): ?string
    {
        return $this->titreCommentaire;
    }

    public function setTitreCommentaire(string $titreCommentaire): self
    {
        $this->titreCommentaire = $titreCommentaire;

        return $this;
    }

    public function getDescriptionCommentaire(): ?string
    {
        return $this->descriptionCommentaire;
    }

    public function setDescriptionCommentaire(?string $descriptionCommentaire): self
    {
        $this->descriptionCommentaire = $descriptionCommentaire;

        return $this;
    }

    public function getNotationCommentaire(): ?int
    {
        return $this->notationCommentaire;
    }

    public function setNotationCommentaire(int $notationCommentaire): self
    {
        $this->notationCommentaire = $notationCommentaire;

        return $this;
    }

    public function getLeCommentaireDunUser(): ?User
    {
        return $this->leCommentaireDunUser;
    }

    public function setLeCommentaireDunUser(?User $leCommentaireDunUser): self
    {
        $this->leCommentaireDunUser = $leCommentaireDunUser;

        return $this;
    }

    public function getLeCommentaireDuLogement(): ?Logement
    {
        return $this->leCommentaireDuLogement;
    }

    public function setLeCommentaireDuLogement(?Logement $leCommentaireDuLogement): self
    {
        $this->leCommentaireDuLogement = $leCommentaireDuLogement;

        return $this;
    }

    /**
     * @return Collection|OffreReservation[]
     */
    public function getLesCommentairesDuneOffre(): Collection
    {
        return $this->lesCommentairesDuneOffre;
    }

    public function addLesCommentairesDuneOffre(OffreReservation $lesCommentairesDuneOffre): self
    {
        if (!$this->lesCommentairesDuneOffre->contains($lesCommentairesDuneOffre)) {
            $this->lesCommentairesDuneOffre[] = $lesCommentairesDuneOffre;
            $lesCommentairesDuneOffre->setUnCommentaireDuneOffre($this);
        }

        return $this;
    }

    public function removeLesCommentairesDuneOffre(OffreReservation $lesCommentairesDuneOffre): self
    {
        if ($this->lesCommentairesDuneOffre->contains($lesCommentairesDuneOffre)) {
            $this->lesCommentairesDuneOffre->removeElement($lesCommentairesDuneOffre);
            // set the owning side to null (unless already changed)
            if ($lesCommentairesDuneOffre->getUnCommentaireDuneOffre() === $this) {
                $lesCommentairesDuneOffre->setUnCommentaireDuneOffre(null);
            }
        }

        return $this;
    }

    public function getActif(): ?int
    {
        return $this->actif;
    }

    public function setActif(int $actif): self
    {
     
        $this->actif = $actif;

        return $this;
    }

   
}
