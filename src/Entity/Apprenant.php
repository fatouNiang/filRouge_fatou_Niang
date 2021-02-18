<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ApprenantRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *      collectionOperations={
 *        "get_apprenant"={ 
 *            "method"="GET", 
 *            "path"="/apprenants",
 *          },
 *            "add_apprenants"={ 
 *               "method"="POST", 
 *               "path"="/apprenants",
 *          },
 *      },
 *      itemOperations={
 *           "get_apprenants_id"={ 
 *               "method"="GET", 
 *               "path"="/apprenants/{id}",
 *         },
 *      },
 * attributes = {"security"="is_granted('ROLE_Formateur') or is_granted('ROLE_Community Manager')" ,
 *              "security_message"="Acces non autorisé"})
 * 
 * )
 * @ORM\Entity(repositoryClass=ApprenantRepository::class)
 */

class Apprenant extends User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $genre;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups ({"apprenant: read","apprenant: write"})

     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups ({"apprenant: read","apprenant: write"})

     */
    private $statut;

    /**
     * @ORM\ManyToOne(targetEntity=ProfilSortie::class, inversedBy="apprenants")
     */
    private $profilSortie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getProfilSortie(): ?ProfilSortie
    {
        return $this->profilSortie;
    }

    public function setProfilSortie(?ProfilSortie $profilSortie): self
    {
        $this->profilSortie = $profilSortie;

        return $this;
    }
}
