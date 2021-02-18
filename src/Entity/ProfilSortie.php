<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use App\Repository\ProfilSortieRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ApiFilter(BooleanFilter::class, properties={"archivage"})
 * @ApiResource(
 *      routePrefix="/admin",
 * 
 *        collectionOperations={
 * 
 *              "get_profilSortie"={
 *               "method"="GET", 
 *              "path"="/profilSorties",
 *              "security" = "is_granted('ROLE_ADMIN')",
 *  
 *          },
 *          "add_profilSortie"={
 *               "method"="POST", 
 *              "path"="/profilSorties",
 *               "security_post_denormalize" = "is_granted('POST', object)"
 *          },
 *      },
 *       itemOperations={
 * 
 *          "get_profilSortie_id"={
 *               "method"="GET", 
 *              "path"="/profilSorties{id}",
 *              "security" = "is_granted('GET', object)"
 *          },
 *            "put_profilSortie_id"={
 *               "method"="PUT", 
 *              "path"="/profilSorties/{id}",
 *              "security" = "is_granted('PUT', object)"
 *          },
 *            "archive_profilSortie_id"={
 *               "method"="DELETE", 
 *              "path"="/profilSorties/{id}",
 *              "security" = "is_granted('DELETE', object)"
 *          },
 *      },
 * attributes={"security_message"="Acces non autorisé"}
 * )
 * @UniqueEntity("libelle", message="ce libelle existe deja")
 * @ORM\Entity(repositoryClass=ProfilSortieRepository::class) 
 */
class ProfilSortie
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
     * @ORM\Column(type="boolean")
     */
    private $archivage=0;

    /**
     * @ORM\OneToMany(targetEntity=Apprenant::class, mappedBy="profilSortie")
     */
    private $apprenants;

    public function __construct()
    {
        $this->apprenants = new ArrayCollection();
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

    public function getArchivage(): ?bool
    {
        return $this->archivage;
    }

    public function setArchivage(bool $archivage): self
    {
        $this->archivage = $archivage;

        return $this;
    }

    /**
     * @return Collection|Apprenant[]
     */
    public function getApprenants(): Collection
    {
        return $this->apprenants;
    }

    public function addApprenant(Apprenant $apprenant): self
    {
        if (!$this->apprenants->contains($apprenant)) {
            $this->apprenants[] = $apprenant;
            $apprenant->setProfilSortie($this);
        }

        return $this;
    }

    public function removeApprenant(Apprenant $apprenant): self
    {
        if ($this->apprenants->removeElement($apprenant)) {
            // set the owning side to null (unless already changed)
            if ($apprenant->getProfilSortie() === $this) {
                $apprenant->setProfilSortie(null);
            }
        }

        return $this;
    }
}
