<?php

namespace App\Entity;

class LogementSearch{


    /**
     * @var string|null 
     */
    private $heureDeDebutMin;


    /**
     * @var string|null 
     */
    private $heureDeFinMax;


    public function getHeureDeDebutMin(): ?string
    {
        return $this->heureDeDebutMin;
    }

    public function setHeureDeDebutMin(string $heureDeDebutMin): self
    {
        $this->heureDeDebutMin = $heureDeDebutMin;

        return $this;
    }

    public function getHeureDeFinMax(): ?string
    {
        return $this->heureDeFinMax;
    }

    public function setHeureDeFinMax(string $heureDeFinMax): self
    {
        $this->heureDeFinMax = $heureDeFinMax;

        return $this;
    }

}