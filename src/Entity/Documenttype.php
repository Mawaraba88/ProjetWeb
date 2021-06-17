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
     * @ORM\Column(type="string", length=255)
     */
    private $picture;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="documenttypes")
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="documenttypes")
     */
    private $author;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_start;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_end;

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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getAuthor(): Collection
    {
        return $this->author;
    }

    public function addAuthor(User $author): self
    {
        if (!$this->author->contains($author)) {
            $this->author[] = $author;
        }

        return $this;
    }

    public function removeAuthor(User $author): self
    {
        $this->author->removeElement($author);

        return $this;
    }

    public function getCreatedStart(): ?\DateTimeInterface
    {
        return $this->created_start;
    }

    public function setCreatedStart(\DateTimeInterface $created_start): self
    {
        $this->created_start = $created_start;

        return $this;
    }

    public function getCreatedEnd(): ?\DateTimeInterface
    {
        return $this->created_end;
    }

    public function setCreatedEnd(\DateTimeInterface $created_end): self
    {
        $this->created_end = $created_end;

        return $this;
    }
}
