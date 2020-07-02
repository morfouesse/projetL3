<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PhotoRepository;
use Symfony\Component\HttpFoundation\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass=PhotoRepository::class)
 * @Vich\Uploadable()
 */
class Photo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var File|null
     * @Vich\UploadableField(mapping="photos", fileNameProperty="nomPhoto")
     */

     private $imageFile;

    /**
     * @ORM\ManyToOne(targetEntity=Logement::class, inversedBy="lesPhotosDunLogement")
     * @ORM\JoinColumn(nullable=false)
     */
    private $unePhotoDunLogement;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255)
     */
    private $nomPhoto;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUnePhotoDunLogement(): ?Logement
    {
        return $this->unePhotoDunLogement;
    }

    public function setUnePhotoDunLogement(?Logement $unePhotoDunLogement): self
    {
        $this->unePhotoDunLogement = $unePhotoDunLogement;

        return $this;
    }

    /**
     * @return null|string 
     */
    public function getNomPhoto(): ?string
    {
        return $this->nomPhoto;
    }

    /**
     * @param null|string $nomPhoto
     * @return Photo
     */
    public function setNomPhoto(string $nomPhoto): self
    {
        $this->nomPhoto = $nomPhoto;

        return $this;
    }

     /**
     * @return null|File 
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param null|string $imageFile
     * @return Photo
     */
    public function setImageFile(string $imageFile): self
    {
        $this->imageFile = $imageFile;
        if($this->imageFile instanceof UploadedFile)
        {
            $this->updated_at = new \DateTime('now');
        }

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }


}
