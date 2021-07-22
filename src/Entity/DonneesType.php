<?php

namespace App\Entity;


/*
/**
 * @ORM\Entity(repositoryClass=DonneesTypeRepository::class)
 */
class DonneesType
{
    /*
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    //private $id;
/*
    /**
     * @ORM\Column(type="string", length=255)
     */
   // private $name;
/*
    /**
     * @ORM\ManyToOne(targetEntity=CategoryDonnees::class, inversedBy="donneesTypes")
     * @ORM\JoinColumn(nullable=false)
     */
   // private $categorydonnees;
/*
    /**
     * @ORM\OneToMany(targetEntity=Documenttype::class, mappedBy="donneesType")
     */
  /*  private $documenttypes;

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

    public function getCategorydonnees(): ?CategoryDonnees
    {
        return $this->categorydonnees;
    }

    public function setCategorydonnees(?CategoryDonnees $categorydonnees): self
    {
        $this->categorydonnees = $categorydonnees;

        return $this;
    }
    public function __toString(){
        return $this->name;
    }

    /**
     * @return Collection|Documenttype[]
     */
    /*public function getDocumenttypes(): Collection
    {
        return $this->documenttypes;
    }

    public function addDocumenttype(Documenttype $documenttype): self
    {
        if (!$this->documenttypes->contains($documenttype)) {
            $this->documenttypes[] = $documenttype;
            $documenttype->setDonneesType($this);
        }

        return $this;
    }

    public function removeDocumenttype(Documenttype $documenttype): self
    {
        if ($this->documenttypes->removeElement($documenttype)) {
            // set the owning side to null (unless already changed)
            if ($documenttype->getDonneesType() === $this) {
                $documenttype->setDonneesType(null);
            }
        }

        return $this;
    }*/
}
