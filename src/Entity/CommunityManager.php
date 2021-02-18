<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommunityManagerRepository;

/**
 * @ORM\Entity(repositoryClass=CommunityManagerRepository::class)
 */
class CommunityManager extends User
{
/**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}

 