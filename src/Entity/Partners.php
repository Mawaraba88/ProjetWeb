<?php

namespace App\Entity;

use App\Repository\PartnersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PartnersRepository::class)
 */
class Partners
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="partners")
     */
    private $organisateurs;

    public function __construct()
    {
        $this->organisateurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }
    public function __toString(){
        return $this->name;
    }

    /**
     * @return Collection|User[]
     */
    public function getOrganisateurs(): Collection
    {
        return $this->organisateurs;
    }

    public function addOrganisateur(User $organisateur): self
    {
        if (!$this->organisateurs->contains($organisateur)) {
            $this->organisateurs[] = $organisateur;
            $organisateur->addPartner($this);
        }

        return $this;
    }

    public function removeOrganisateur(User $organisateur): self
    {
        if($this->organisateurs->removeElement($organisateur)){
            $organisateur->removePartner($this);
        }

        return $this;
    }
}
