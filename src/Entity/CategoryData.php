<?php

namespace App\Entity;

use App\Repository\CategoryDataRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryDataRepository::class)
 */
class CategoryData
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
     * @ORM\OneToMany(targetEntity=TypeData::class, mappedBy="categorydata")
     */
    private $typeData;

    public function __construct()
    {
        $this->typeData = new ArrayCollection();
    }

    /**
     * @return Collection|TypeData[]
     */
    public function getTypeData(): Collection
    {
        return $this->typeData;
    }

    public function addTypeData(TypeData $typeData): self
    {
        if (!$this->typeData->contains($typeData)) {
            $this->typeData[] = $typeData;
            $typeData->setCategorydata($this);
        }

        return $this;
    }

    public function removeTypeData(TypeData $typeData): self
    {
        if ($this->typeData->removeElement($typeData)) {
            // set the owning side to null (unless already changed)
            if ($typeData->getCategorydata() === $this) {
                $typeData->setCategorydata(null);
            }
        }

        return $this;
    }




}
