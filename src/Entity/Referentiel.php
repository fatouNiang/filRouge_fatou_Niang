<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ReferentielRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ApiResource(
 *    routePrefix="/admin",
 *      collectionOperations={"get", "post"},
 *       itemOperations={"get","put", "delete"},
 * normalizationContext = {"groups" = {"referentiel: read"}},
 * denormalizationContext = {"groups" = {"referentiel: write"}}
 * )
 * @UniqueEntity("libelle", message="ce libelle existe deja")
 * @ORM\Entity(repositoryClass=ReferentielRepository::class)
 */
class Referentiel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"referentiel: read", "referentiel: write"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"referentiel: read", "referentiel: write"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="text")
     * @Groups({"referentiel: read", "referentiel: write"})

     */
    private $presentation;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"referentiel: read", "referentiel: write"})

     */
    private $programme;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"referentiel: read", "referentiel: write"})

     */
    private $criteraAdmission;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"referentiel: read", "referentiel: write"})
     */
    private $critereEvaluation;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"referentiel: read", "referentiel: write"})

     */
    private $archivage=0;

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

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(string $presentation): self
    {
        $this->presentation = $presentation;

        return $this;
    }

    public function getProgramme(): ?string
    {
        return $this->programme;
    }

    public function setProgramme(string $programme): self
    {
        $this->programme = $programme;

        return $this;
    }

    public function getCriteraAdmission(): ?string
    {
        return $this->criteraAdmission;
    }

    public function setCriteraAdmission(string $criteraAdmission): self
    {
        $this->criteraAdmission = $criteraAdmission;

        return $this;
    }

    public function getCritereEvaluation(): ?string
    {
        return $this->critereEvaluation;
    }

    public function setCritereEvaluation(string $critereEvaluation): self
    {
        $this->critereEvaluation = $critereEvaluation;

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
