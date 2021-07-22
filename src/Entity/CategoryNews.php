<?php

namespace App\Entity;

use App\Repository\CategoryNewsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryNewsRepository::class)
 */
class CategoryNews
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
     * @ORM\OneToMany(targetEntity=News::class, mappedBy="categorynews")
     */
    private $newstypes;

    public function __construct()
    {
        $this->newstypes = new ArrayCollection();
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
     * @return Collection|News[]
     */
    public function getNewstypes(): Collection
    {
        return $this->newstypes;
    }

    public function addNewstype(News $newstype): self
    {
        if (!$this->newstypes->contains($newstype)) {
            $this->newstypes[] = $newstype;
            $newstype->setCategorynews($this);
        }

        return $this;
    }

    public function removeNewstype(News $newstype): self
    {
        if ($this->newstypes->removeElement($newstype)) {
            // set the owning side to null (unless already changed)
            if ($newstype->getCategorynews() === $this) {
                $newstype->setCategorynews(null);
            }
        }

        return $this;
    }
}

