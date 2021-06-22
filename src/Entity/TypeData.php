<?php

namespace App\Entity;

use App\Repository\TypeDataRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeDataRepository::class)
 */
class TypeData
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
     * @ORM\ManyToOne(targetEntity=CategoryData::class, inversedBy="typeData")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorydata;

    /**
     * @ORM\OneToMany(targetEntity=Documenttype::class, mappedBy="typeData")
     */
    private $documenttypes;

    public function __construct()
    {
        $this->documenttypes = new ArrayCollection();
    }

    public function getCategorydata(): ?CategoryData
    {
        return $this->categorydata;
    }

    public function setCategorydata(?CategoryData $categorydata): self
    {
        $this->categorydata = $categorydata;

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
            $documenttype->setTypeData($this);
        }

        return $this;
    }

    public function removeDocumenttype(Documenttype $documenttype): self
    {
        if ($this->documenttypes->removeElement($documenttype)) {
            // set the owning side to null (unless already changed)
            if ($documenttype->getTypeData() === $this) {
                $documenttype->setTypeData(null);
            }
        }

        return $this;
    }


}
