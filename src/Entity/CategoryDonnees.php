<?php

namespace App\Entity;

use App\Repository\CategoryDonneesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryDonneesRepository::class)
 */
class CategoryDonnees
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
/*
    /**
     * @ORM\OneToMany(targetEntity=DonneesType::class, mappedBy="categorydonnees")
     */
    //private $donneesTypes;

    /**
     * @ORM\OneToMany(targetEntity=Documenttype::class, mappedBy="categorydonnees")
     */
    private $documenttypes;

    public function __construct()
    {
       // $this->donneesTypes = new ArrayCollection();
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
    public function __toString(){
        return $this->name;
    }
/*
    /**
     * @return Collection|DonneesType[]
     */
    /*
    public function getDonneesTypes(): Collection
    {
        return $this->donneesTypes;
    }

    public function addDonneesType(DonneesType $donneesType): self
    {
        if (!$this->donneesTypes->contains($donneesType)) {
            $this->donneesTypes[] = $donneesType;
            $donneesType->setCategorydonnees($this);
        }

        return $this;
    }

    public function removeDonneesType(DonneesType $donneesType): self
    {
        if ($this->donneesTypes->removeElement($donneesType)) {
            // set the owning side to null (unless already changed)
            if ($donneesType->getCategorydonnees() === $this) {
                $donneesType->setCategorydonnees(null);
            }
        }

        return $this;
    }
    */

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
            $documenttype->setCategorydonnees($this);
        }

        return $this;
    }

    public function removeDocumenttype(Documenttype $documenttype): self
    {
        if ($this->documenttypes->removeElement($documenttype)) {
            // set the owning side to null (unless already changed)
            if ($documenttype->getCategorydonnees() === $this) {
                $documenttype->setCategorydonnees(null);
            }
        }

        return $this;
    }
}
