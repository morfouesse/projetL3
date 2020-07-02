<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface

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
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

      /**
     * @ORM\Column(type="json")
    */
    private $roles = [];



    /**
     * @ORM\OneToMany(targetEntity=OffreReservation::class, mappedBy="uneReservationDunUser")
     */
    private $lesReservationsDunUser;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="leCommentaireDunUser")
     */
    private $lesCommentairesDunUser;

    public function __construct()
    {
        $this->lesReservationsDunUser = new ArrayCollection();
        $this->lesCommentairesDunUser = new ArrayCollection();
    }

 

   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection|OffreReservation[]
     */
    public function getIdOffreReservation(): Collection
    {
        return $this->lesReservationsDunUser;
    }

    public function addIdOffreReservation(OffreReservation $lesReservationsDunUser): self
    {
        if (!$this->lesReservationsDunUser->contains($lesReservationsDunUser)) {
            $this->lesReservationsDunUser[] = $lesReservationsDunUser;
            $lesReservationsDunUser->setReservationDunUser($this);
        }

        return $this;
    }

    public function removeIdOffreReservation(OffreReservation $lesReservationsDunUser): self
    {
        if ($this->lesReservationsDunUser->contains($lesReservationsDunUser)) {
            $this->lesReservationsDunUser->removeElement($lesReservationsDunUser);
            // set the owning side to null (unless already changed)
            if ($lesReservationsDunUser->getReservationDunUser() === $this) {
                $lesReservationsDunUser->setReservationDunUser(null);
            }
        }

        return $this;
    }

 


    
      #neccessaire pour connexion
      /**
       * @see UserInterface
       */
      public function getRoles(): array //renvoi un tableau qui explique le role de 
    {
      $roles = $this->roles;
      // guarantee every user at least has ROLE_USER
      $roles[] = "ROLE_USER";
     
      
      return array_unique($roles);
    }

    public function addRole($roles)
    {
       $roles = strtoupper($roles);
        if(!in_array($roles,$this->roles,true)){
            $this->roles[]=$roles;
        }

        return $this;
    }

    public function getSalt()
    {
    }

    public function eraseCredentials() // obliger de mettrre supprime les données sensibles chez le user
    {
    }

    /**
     * @return Collection|Commentaire[]
     */
    public function getLesCommentairesDunUser(): Collection
    {
        return $this->lesCommentairesDunUser;
    }

    public function addLesCommentairesDunUser(Commentaire $lesCommentairesDunUser): self
    {
        if (!$this->lesCommentairesDunUser->contains($lesCommentairesDunUser)) {
            $this->lesCommentairesDunUser[] = $lesCommentairesDunUser;
            $lesCommentairesDunUser->setLeCommentaireDunUser($this);
        }

        return $this;
    }

    public function removeLesCommentairesDunUser(Commentaire $lesCommentairesDunUser): self
    {
        if ($this->lesCommentairesDunUser->contains($lesCommentairesDunUser)) {
            $this->lesCommentairesDunUser->removeElement($lesCommentairesDunUser);
            // set the owning side to null (unless already changed)
            if ($lesCommentairesDunUser->getLeCommentaireDunUser() === $this) {
                $lesCommentairesDunUser->setLeCommentaireDunUser(null);
            }
        }

        return $this;
    }

    

}
