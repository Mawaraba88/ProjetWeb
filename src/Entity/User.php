<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 *@Vich\Uploadable
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{

    const STUDYLEVEL = [
        0 => 'Master',
        1 => 'Doctorat'
    ];
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isValide;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fieldOfResearch;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $place;


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



    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string|null
     */
    private $picture;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $webSite;





    public function __construct()
    {
        $this->documenttypes = new ArrayCollection();
        $this->partners = new ArrayCollection();
        $this->newstypes = new ArrayCollection();
        $this->updateAt = new \DateTime();



    }

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

    public function getUsername()
    {
        // TODO: Implement getUsername() method.
    }

    public function setUsername(?string $username): self
    {
        $this->username = $username;

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

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getIsValide(): ?bool
    {
        return $this->isValide;
    }

    public function setIsValide(?bool $isValide): self
    {
        $this->isValide = $isValide;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getFieldOfResearch(): ?string
    {
        return $this->fieldOfResearch;
    }

    public function setFieldOfResearch(?string $fieldOfResearch): self
    {
        $this->fieldOfResearch = $fieldOfResearch;

        return $this;
    }

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function setPlace(?string $place): self
    {
        $this->place = $place;

        return $this;
    }


    public function __toString(){
        return $this->firstname. ' '.$this->lastname;
    }

    public function getFullname(): ?string
    {
        return $this->lastname . ' ' . $this->firstname;
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

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getWebSite(): ?string
    {
        return $this->webSite;
    }

    public function setWebSite(?string $webSite): self
    {
        $this->webSite = $webSite;

        return $this;
    }

    // ... other fields

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="images_directory", fileNameProperty="picture")
     *
     * @var File|null
     * @Assert\Image(maxSize="8M")
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updateAt;






    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->setUpdateAt(new \DateTimeImmutable);
        }

    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->updateAt;
    }

    public function setUpdateAt(?\DateTimeInterface $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }


}
