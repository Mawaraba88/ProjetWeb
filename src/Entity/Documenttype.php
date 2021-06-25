<?php

namespace App\Entity;

use App\Repository\DocumenttypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DocumenttypeRepository::class)
 */
class Documenttype
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
     * @ORM\Column(type="text")
     */
    private $resume;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;


    /**
     * @ORM\ManyToMany(targetEntity=Users::class, inversedBy="documenttypes")
     */
    private $author;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $startCreatedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $endCreatedAt;



    /**
     * @ORM\ManyToOne(targetEntity=DonneesType::class, inversedBy="documenttypes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $donneesType;

    /**
     * @ORM\ManyToOne(targetEntity=CategoryDonnees::class, inversedBy="documenttypes")
     */
    private $categorydonnees;

    public function __construct()
    {
        $this->author = new ArrayCollection();
        $this->createdAt = new \DateTime();

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

    public function setResume(string $resume): self
    {
        $this->resume = $resume;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
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



    /**
     * @return Collection|Users[]
     */
    public function getAuthor(): Collection
    {
        return $this->author;
    }

    public function addAuthor(Users $author): self
    {
        if (!$this->author->contains($author)) {
            $this->author[] = $author;
        }

        return $this;
    }

    public function removeAuthor(Users $author): self
    {
        $this->author->removeElement($author);

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



    public function getDonneesType(): ?DonneesType
    {
        return $this->donneesType;
    }

    public function setDonneesType(?DonneesType $donneesType): self
    {
        $this->donneesType = $donneesType;

        return $this;
    }

    public function getCategorydonnees(): ?CategoryDonnees
    {
        return $this->categorydonnees;
    }

    public function setCategorydonnees(?CategoryDonnees $categorydonnees): self
    {
        $this->categorydonnees = $categorydonnees;

        return $this;
    }

}
