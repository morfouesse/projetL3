<?php

namespace App\Entity;

use App\Repository\EquipementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EquipementRepository::class)
 */
class Equipement
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
    private $nomEquipement;

    /**
     * @ORM\OneToMany(targetEntity=EquipementDunLogement::class, mappedBy="lequipement")
     */
    private $equipementDunLogements;

    public function __construct()
    {
        $this->equipementDunLogements = new ArrayCollection();
    }

  

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEquipement(): ?string
    {
        return $this->nomEquipement;
    }

    public function setNomEquipement(string $nomEquipement): self
    {
        $this->nomEquipement = $nomEquipement;

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
            $equipementDunLogement->setLequipement($this);
        }

        return $this;
    }

    public function removeEquipementDunLogement(EquipementDunLogement $equipementDunLogement): self
    {
        if ($this->equipementDunLogements->contains($equipementDunLogement)) {
            $this->equipementDunLogements->removeElement($equipementDunLogement);
            // set the owning side to null (unless already changed)
            if ($equipementDunLogement->getLequipement() === $this) {
                $equipementDunLogement->setLequipement(null);
            }
        }

        return $this;
    }

   

}
