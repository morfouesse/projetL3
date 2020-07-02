<?php

namespace App\Entity;

use App\Repository\OffreReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OffreReservationRepository::class)
 */
class OffreReservation
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
    private $heureOffreDebut;

    /**
     * @ORM\Column(type="integer")
     */
    private $reserverOffre;


    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="lesReservationsDunUser")
     */
    private $uneReservationDunUser;

    /**
     * @ORM\ManyToOne(targetEntity=Logement::class, inversedBy="lesOffresdeReservationDunLogement")
     * @ORM\JoinColumn(nullable=false)
     */
    private $uneReservationDunLogement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $heureOffreFin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dateOffre;

    /**
     * @ORM\ManyToOne(targetEntity=Commentaire::class, inversedBy="lesCommentairesDuneOffre")
     */
    private $unCommentaireDuneOffre;

    /**
     * @ORM\Column(type="integer")
     */
    private $dateActif;

  
   
   


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeureOffreDebut(): ?string
    {
        return $this->heureOffreDebut;
    }

    public function setHeureOffreDebut(?string $heureOffreDebut): self
    {
        $this->heureOffreDebut = $heureOffreDebut;

        return $this;
    }

    public function getReserverOffre(): ?int
    {
        return $this->reserverOffre;
    }

    public function setReserverOffre(int $reserverOffre): self
    {
        $this->reserverOffre = $reserverOffre;

        return $this;
    }

    public function getUneReservationDunUser(): ?User
    {
        return $this->uneReservationDunUser;
    }

    public function setUneReservationDunUser(?User $uneReservationDunUser): self
    {
        $this->uneReservationDunUser = $uneReservationDunUser;

        return $this;
    }

    public function getUneReservationDunLogement(): ?Logement
    {
        return $this->uneReservationDunLogement;
    }

    public function setUneReservationDunLogement(?Logement $uneReservationDunLogement): self
    {
        $this->uneReservationDunLogement = $uneReservationDunLogement;

        return $this;
    }

    public function getHeureOffreFin(): ?string
    {
        return $this->heureOffreFin;
    }

    public function setHeureOffreFin(string $heureOffreFin): self
    {
        $this->heureOffreFin = $heureOffreFin;

        return $this;
    }

    public function getDateOffre(): ?string
    {
        return $this->dateOffre;
    }

    public function setDateOffre(string $dateOffre): self
    {
        $this->dateOffre = $dateOffre;

        return $this;
    }

    public function getUnCommentaireDuneOffre(): ?Commentaire
    {
        return $this->unCommentaireDuneOffre;
    }

    public function setUnCommentaireDuneOffre(?Commentaire $unCommentaireDuneOffre): self
    {
        $this->unCommentaireDuneOffre = $unCommentaireDuneOffre;

        return $this;
    }

    public function getDateActif(): ?int
    {
        return $this->dateActif;
    }

    public function setDateActif(int $dateActif): self
    {
        $this->dateActif = $dateActif;

        return $this;
    }

 
  

   

}
