<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Documenttype::class, mappedBy="category")
     */
    private $documenttypes;

    public function __construct()
    {
        $this->documenttypes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Documenttype[]
     */
    public function getDocumenttypes(): Collection
    {
        return $this->documenttypes;
    }

    public function addDocumenttype(Documenttype $documenttype): self
    {
        if (!$this->documenttypes->contains($documenttype)) {
            $this->documenttypes[] = $documenttype;
            $documenttype->setCategory($this);
        }

        return $this;
    }

    public function removeDocumenttype(Documenttype $documenttype): self
    {
        if ($this->documenttypes->removeElement($documenttype)) {
            // set the owning side to null (unless already changed)
            if ($documenttype->getCategory() === $this) {
                $documenttype->setCategory(null);
            }
        }

        return $this;
    }
}
