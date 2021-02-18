<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\GroupeTagRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ApiResource(
 *      routePrefix="/admin",
 *      collectionOperations={
 *          "Get_grptags"={
 *              "method"="GET",
 *              "path"="/grptags",
 *              "security"= "is_granted('VIEW_ALL', object)"      

 *              
 *          },
 *          "post_grptag"={
 *              "method"="POST",
 *              "path"="/grptags", 
 *               "security_post_denormalize" = "is_granted('POST', object)"
     
 *      },
 * },
 *      itemOperations={
 *          "get_Id_grptag"={
 *              "method"="GET",
 *              "path"="/grptags/{id}",
 *              "security"= "is_granted('VIEW', object)"      

 *          },
 * 
 *          "get_grptag_id_tag"={
 *              "method"="GET",
 *              "path"="/grptags/{id}/tags",
 *      },
 *          "put_Id_grptag"={
 *              "method"="PUT",
 *              "path"="/grptags/{id}",
  *              "security"= "is_granted('EDIT', object)"      

 *          },
 *          "delete_Id_grptag"={
 *              "method"="DELETE",
 *              "path"="/grptags/{id}",
  *              "security"= "is_granted('DELETE', object)"      

 *          },
 *      },
 * attributes={"security_message"="vous n'avez pas acces acces a cet ressource"}
 * )
 * @UniqueEntity("libelle", message="ce libelle existe deja")
 * @ORM\Entity(repositoryClass=GroupeTagRepository::class)
 */
class GroupeTag
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *      
     * @Assert\NotBlank(message = "veillez saisir le libelle")
     */
    private $libelle;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message = "veillez saisir la description")

     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=Tag::class, mappedBy="groupeTag")
     */
    private $tags;

    /**
     * @ORM\Column(type="boolean")
     */
    private $archivage=0;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
            $tag->addGroupeTag($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->removeElement($tag)) {
            $tag->removeGroupeTag($this);
        }

        return $this;
    }

    public function getArchivage(): ?bool
    {
        return $this->archivage;
    }

    public function setArchivage(bool $archivage): self
    {
        $this->archivage = $archivage;

        return $this;
    }
}
