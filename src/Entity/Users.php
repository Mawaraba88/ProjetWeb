<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Connections\MasterSlaveConnection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class Users implements UserInterface, PasswordAuthenticatedUserInterface
{
    const STUDYLEVEL = [
        0 => 'Master',
        1 => 'Doctorat'
    ];
/*
    const PARTNERS = [
        0 => 'Laboratoire',
        1 => 'Universite de Tours',
        3 => 'Partenaire 3'
    ];*/
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;



    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @ORM\ManyToMany(targetEntity=Documenttype::class, mappedBy="author")
     */
    private $documenttypes;

    /**
     * @ORM\ManyToMany(targetEntity=Partners::class, mappedBy="organisateurs")
     */
    private $partners;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $studylevel;

    /**
     * @ORM\ManyToMany(targetEntity=News::class, mappedBy="authors")
     */
    private $newstypes;




    public function __construct()
    {
        $this->documenttypes = new ArrayCollection();
        $this->partners = new ArrayCollection();
        $this->newstypes = new ArrayCollection();

    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getFullname(): ?string
    {
        return $this->lastname . ' ' . $this->firstname;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function __toString(){
        return $this->firstname. ' '.$this->lastname;
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
            $documenttype->addAuthor($this);
        }

        return $this;
    }

    public function removeDocumenttype(Documenttype $documenttype): self
    {
        if ($this->documenttypes->removeElement($documenttype)) {
            $documenttype->removeAuthor($this);
        }

        return $this;
    }

    /**
     * @return Collection|Partners[]
     */
    public function getPartners(): Collection
    {
        return $this->partners;
    }

    public function addPartner(Partners $partner): self
    {
        if (!$this->partners->contains($partner)) {
            $this->partners[] = $partner;
            $partner->addOrganisateur($this);
        }

        return $this;
    }

    public function removePartner(Partners $partner): self
    {
        if ($this->partners->removeElement($partner)) {
            $partner->removeOrganisateur($this);
        }

        return $this;
    }

    public function getStudylevel(): ?string
    {
        return $this->studylevel;
    }

    public function setStudylevel(?string $studylevel): self
    {
        $this->studylevel = $studylevel;

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
            $newstype->addAuthor($this);
        }

        return $this;
    }

    public function removeNewstype(News $newstype): self
    {
        if ($this->newstypes->removeElement($newstype)) {
            $newstype->removeAuthor($this);
        }

        return $this;
    }


}
