<?php

namespace App\Entity;

use App\Repository\EquipementDunLogementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EquipementDunLogementRepository::class)
 */
class EquipementDunLogement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Logement::class, inversedBy="equipementDunLogements")
     */
    private $leLogement;

    /**
     * @ORM\ManyToOne(targetEntity=Equipement::class, inversedBy="equipementDunLogements")
     */
    private $lequipement;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLeLogement(): ?Logement
    {
        return $this->leLogement;
    }

    public function setLeLogement(?Logement $leLogement): self
    {
        $this->leLogement = $leLogement;

        return $this;
    }

    public function getLequipement(): ?Equipement
    {
        return $this->lequipement;
    }

    public function setLequipement(?Equipement $lequipement): self
    {
        $this->lequipement = $lequipement;

        return $this;
    }
}
