<?php

namespace App\Entity;

use App\Repository\NewsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=NewsRepository::class)
 * @Vich\Uploadable
 */
class News
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $resume;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string|null
     */
    private $picture;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $startCreatedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $endCreatedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $place;
/*
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
  //  private $brochureFileName;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isActive;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="newstypes")
     */
    private $authors;

    /**
     * @ORM\ManyToOne(targetEntity=CategoryNews::class, inversedBy="newstypes")
     */
    private $categorynews;

    public function __construct()
    {
        $this->authors = new ArrayCollection();
        $this->createdAt = new \DateTime();
        $this->updateAt = new \DateTime();
        $this->durationOfPublication=7;

    }




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(?string $resume): self
    {
        $this->resume = $resume;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getStartCreatedAt(): ?\DateTimeInterface
    {
        return $this->startCreatedAt;
    }

    public function setStartCreatedAt(?\DateTimeInterface $startCreatedAt): self
    {
        $this->startCreatedAt = $startCreatedAt;

        return $this;
    }

    public function getEndCreatedAt(): ?\DateTimeInterface
    {
        return $this->endCreatedAt;
    }

    public function setEndCreatedAt(?\DateTimeInterface $endCreatedAt): self
    {
        $this->endCreatedAt = $endCreatedAt;

        return $this;
    }

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function setPlace(?string $place): self
    {
        $this->place = $place;

        return $this;
    }
/*
    public function getBrochureFileName(): ?string
    {
        return $this->brochureFileName;
    }

    public function setBrochureFileName(?string $brochureFileName): self
    {
        $this->brochureFileName = $brochureFileName;

        return $this;
    }
*/
    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(?bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getAuthors(): Collection
    {
        return $this->authors;
    }

    public function addAuthor(User $author): self
    {
        if (!$this->authors->contains($author)) {
            $this->authors[] = $author;
        }

        return $this;
    }

    public function removeAuthor(User $author): self
    {
        $this->authors->removeElement($author);

        return $this;
    }

    public function getCategorynews(): ?CategoryNews
    {
        return $this->categorynews;
    }

    public function setCategorynews(?CategoryNews $categorynews): self
    {
        $this->categorynews = $categorynews;

        return $this;
    }

    /**
     * @ORM\Column(type="datetime")
     */
    private $updateAt;



    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $durationOfPublication;

    /**
     * @return mixed
     */
    public function getDurationOfPublication()
    {
        return $this->durationOfPublication;
    }

    /**
     * @param mixed $durationOfPublication
     */
    public function setDurationOfPublication($durationOfPublication): void
    {
        $this->durationOfPublication = $durationOfPublication;
    }

    /**
     * @return mixed
     */
    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->updateAt;
    }

    /**
     * @param mixed $updateAt
     */
    public function setUpdateAt(?\DateTimeInterface $updateAt): void
    {
        $this->updateAt = $updateAt;
    }



    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="images_directory", fileNameProperty="picture")
     *
     * @var File|null
     * @Assert\Image(maxSize="8M")
     */
    private $imageFile;


    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->setUpdateAt(new \DateTimeImmutable);
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }




}
