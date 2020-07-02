<?php

namespace App\Entity;

use App\Repository\VilleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VilleRepository::class)
 */
class Ville
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
    private $nomVille;

    /**
     * @ORM\OneToMany(targetEntity=Logement::class, mappedBy="laVilleDunLogement")
     */
    private $lesLogementsDuneVille;

    public function __construct()
    {
        $this->lesLogementsDuneVille = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomVille(): ?string
    {
        return $this->nomVille;
    }

    public function setNomVille(string $nomVille): self
    {
        $this->nomVille = $nomVille;

        return $this;
    }

    /**
     * @return Collection|Logement[]
     */
    public function getLesLogementsDuneVille(): Collection
    {
        return $this->lesLogementsDuneVille;
    }

    public function addLesLogementsDuneVille(Logement $lesLogementsDuneVille): self
    {
        if (!$this->lesLogementsDuneVille->contains($lesLogementsDuneVille)) {
            $this->lesLogementsDuneVille[] = $lesLogementsDuneVille;
            $lesLogementsDuneVille->setLaVilleDunLogement($this);
        }

        return $this;
    }

    public function removeLesLogementsDuneVille(Logement $lesLogementsDuneVille): self
    {
        if ($this->lesLogementsDuneVille->contains($lesLogementsDuneVille)) {
            $this->lesLogementsDuneVille->removeElement($lesLogementsDuneVille);
            // set the owning side to null (unless already changed)
            if ($lesLogementsDuneVille->getLaVilleDunLogement() === $this) {
                $lesLogementsDuneVille->setLaVilleDunLogement(null);
            }
        }

        return $this;
    }
}
