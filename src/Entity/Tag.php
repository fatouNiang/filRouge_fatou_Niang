<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TagRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ApiResource(
 *      routePrefix="/admin",
 *      collectionOperations={
 *          "Get_tags"={
 *              "method"="GET",
 *              "path"="/tags", 
 *              "security" = "is_granted('GET', object)"
     
 *          },
 *          "post_tag"={
 *              "method"="POST",
 *              "path"="/tags",
 *              "security" = "is_granted('POST', object)"
      
 *      },
 * },
 *      itemOperations={
 *          "get_Id_tag"={
 *              "method"="GET",
 *              "path"="/tags/{id}",
 *              "security" = "is_granted('GET', object)"

 *          },
 *          "put_Id_tag"={
 *              "method"="PUT",
 *              "path"="/tags/{id}",
 *              "security" = "is_granted('GET', object)"

 *          },
 *          "delete_Id_tag"={
 *              "method"="DELETE",
 *              "path"="/tags/{id}",
 *              "security" = "is_granted('DELETE', object)"

 *          },
 *      },
 * )
 * @ORM\Entity(repositoryClass=TagRepository::class)
 * @UniqueEntity("libelle", message="ce libelle existe deja")

 */
class Tag
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message = "veillez saisir le libelle")
     */
    private $libelle;

    /**
     * @ORM\ManyToMany(targetEntity=GroupeTag::class, inversedBy="tags")
     */
    private $groupeTag;

    /**
     * @ORM\Column(type="boolean")
     */
    private $archivage=0;

    public function __construct()
    {
        $this->groupeTag = new ArrayCollection();
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

    /**
     * @return Collection|GroupeTag[]
     */
    public function getGroupeTag(): Collection
    {
        return $this->groupeTag;
    }

    public function addGroupeTag(GroupeTag $groupeTag): self
    {
        if (!$this->groupeTag->contains($groupeTag)) {
            $this->groupeTag[] = $groupeTag;
        }

        return $this;
    }

    public function removeGroupeTag(GroupeTag $groupeTag): self
    {
        $this->groupeTag->removeElement($groupeTag);

        return $this;
    }

    public function getArchivage(): ?bool
    {
        return $this->archvage;
    }

    public function setArchivage(bool $archvage): self
    {
        $this->archvage = $archvage;

        return $this;
    }
}
