<?php
// src/IPS/StructureBundle/Entity/Image

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Table(name="Document")
 * @ORM\Entity(repositoryClass="App\Repository\DocumentRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Document
{
  /**
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @ORM\Column(name="Format", type="string", length=255, nullable=true)
   */
  private $format;

  /**
   * @ORM\Column(name="Nom", type="string", length=255, nullable=true)
   */
  private $nom;

  private $file;

   // On ajoute cet attribut pour y stocker le nom du fichier temporairement
  private $tempFilename;

  /**
   * @ORM\ManyToMany(targetEntity=Documenttype::class, inversedBy="documents")
   */
  private $documents;

  public function __construct()
  {
      $this->documents = new ArrayCollection();
  }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set format
     *
     * @param string $format
     *
     * @return Document
     */
    public function setFormat($format)
    {
        $this->format = $format;

        return $this;
    }

    /**
     * Get format
     *
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Document
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    public function getFile()
    {
        return $this->file;
    }

  /*public function setFile(UploadedFile $file = null)
  {
    $this->file = $file;
  }*/

  // On modifie le setter de File, pour prendre en compte l'upload d'un fichier lorsqu'il en existe déjà un autre
  public function setFile(UploadedFile $file)
  {
    $this->file = $file;

    // On vérifie si on avait déjà un fichier pour cette entité
    if (null !== $this->format) {
      // On sauvegarde l'extension du fichier pour le supprimer plus tard
      $this->tempFilename = $this->format;

      // On réinitialise les valeurs des attributs format et nom
      $this->format = null;
      $this->nom = null;
    }
  }

  public function getWebPath()
  {
    return $this->getUploadDir().'/'.$this->getNom().'.'.$this->getFormat();
  }


  public function getWebPathNom()
  {
    return $this->getUploadDir().'/'.$this->getNom();
  }

  /**
   * @ORM\PrePersist()
   * @ORM\PreUpdate()
   */
  public function preUpload()
  {
    // Si jamais il n'y a pas de fichier (champ facultatif), on ne fait rien
    if (null === $this->file) {
      return;
    }

    // Le nom du fichier est son id, on doit juste stocker également son extension
    // Pour faire propre, on devrait renommer cet attribut en « extension », plutôt que « url »
    $this->format = $this->file->guessExtension();
    //die(var_dump(basename($this->file->getClientOriginalName(), "." . $this->format)));
    // Et on génère l'attribut nom de la balise <img>, à la valeur du nom du fichier sur le PC de l'internaute
    $this->nom = basename($this->file->getClientOriginalName(), "." . $this->format);
  }

  /**
   * @ORM\PostPersist()
   * @ORM\PostUpdate()
   */
  public function upload()
  {
    // Si jamais il n'y a pas de fichier (champ facultatif), on ne fait rien
    if (null === $this->file) {
      return;
    }

    // Si on avait un ancien fichier, on le supprime
    if (null !== $this->tempFilename) {
      $oldFile = $this->getUploadRootDir().'/'.$this->nom.'.'.$this->tempFilename;
      if (file_exists($oldFile)) {
        unlink($oldFile);
      }
    }

    // On déplace le fichier envoyé dans le répertoire de notre choix
    $this->file->move(
      $this->getUploadRootDir(), // Le répertoire de destination
      $this->nom.'.'.$this->format   // Le nom du fichier à créer, ici « nom.extension »
    );
  }

  /**
   * @ORM\PreRemove()
   */
  public function preRemoveUpload()
  {
    // On sauvegarde temporairement le nom du fichier, car il dépend du nom
    $this->tempFilename = $this->getUploadRootDir().'/'.$this->nom.'.'.$this->format;
    //die(var_dump("1 " . $this->tempFilename));
    $this->removeUpload();
  }

  /**
   * @ORM\PostRemove()
   */
  public function removeUpload()
  {
    //die(var_dump(file_exists($this->tempFilename)));
    // En PostRemove, on n'a pas accès à l'id, on utilise notre nom sauvegardé
    if (file_exists($this->tempFilename)) {
      // On supprime le fichier
      unlink($this->tempFilename);
    }
  }

  public function getRemove() {
    $this->preRemoveUpload();
    $this->removeUpload();
  }

  public function getUploadDir()
  {
    // On retourne le chemin relatif vers l'document pour un navigateur
    return './uploads';
  }

  public function getUploadRootDir()
  {
    // On retourne le chemin relatif vers l'document pour notre code PHP
    return $this->getUploadDir();
  }

  public function getUploadFileFromRootDir()
  {
    // On retourne le chemin relatif vers l'document pour notre code PHP
    return $this->getWebPath();
  }

  /**
   * @return Collection|Documenttype[]
   */
  public function getDocuments(): Collection
  {
      return $this->documents;
  }

  public function addDocument(Documenttype $document): self
  {
      if (!$this->documents->contains($document)) {
          $this->documents[] = $document;
      }

      return $this;
  }

  public function removeDocument(Documenttype $document): self
  {
      $this->documents->removeElement($document);

      return $this;
  }
}
