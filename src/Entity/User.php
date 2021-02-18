<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping\InheritanceType;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 *
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"user"="User","admin"="Admin","apprenant" = "Apprenant","formateur"="Formateur","cm"="CommunityManager"})
 * @ApiFilter(BooleanFilter::class, properties={"archivage"})
 * @ApiResource(
 *      routePrefix="/admin",
 *    collectionOperations={
 *        "get_users"={ 
 *            "method"="GET", 
 *            "path"="/users",
 *          },
 *            "add_users"={ 
 *               "method"="POST", 
 *               "path"="/users",
 *          },
 * },
 *      itemOperations={
 *          "get_users_id"={ 
 *               "method"="GET", 
 *               "path"="/users/{id}",
 *          },
 *      "put_users"={ 
 *               "method"="PUT", 
 *               "path"="/users/{id}",
 *          },
 *      "archive_users"={ 
 *               "method"="DELETE", 
 *               "path"="/users/{id}",
 *          },
 * },
 * normalizationContext = {"groups" = {"user: read"}},
 * denormalizationContext = {"groups" = {"user: write"}},
 * )
 */ 

class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @Groups ({"user: read"})
     * @ORM\Column(type="integer")
     */
    protected $id;

     /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups ({"user: read","user: write"})
     */
    private $username;

    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Groups ({"user: write","formateur:write"})
     */
    private $password;

    /**
     * @Groups ({"user: write"})
     */
    private $plainPassword;  

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups ({"user: read","user: write"})
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups ({"user: read","user: write"})
     */
    private $LastName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups ({"user: read","user: write"})
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity=Profil::class, inversedBy="users")
     * @Groups ({"profil: read","profil: write"})
     */
    private $profil;

 /**
     * @ORM\Column(type="blob", nullable=true)
     * @Groups({"user: read","user: write"})
     */
    private $photo;

    /**
     * @ORM\Column(type="boolean")
     * @Groups ({"user: read","user: write"})
     */
    private $archivage=0;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }
    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_'.$this->profil->getLibelle();

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        $this->plainPassword = null;
    }
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->LastName;
    }

    public function setLastName(string $LastName): self
    {
        $this->LastName = $LastName;

        return $this;
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

    public function getProfil(): ?Profil
    {
        return $this->profil;
    }

    public function setProfil(?Profil $profil): self
    {
        $this->profil = $profil;

        return $this;
    }
    public function getPhoto()
    {
        //return $this->photo;
        
        if($this->photo){
            $photo=stream_get_contents($this->photo);
            if(!$this->photo){
                @fclose($this->photo);

            }
            return base64_encode($photo);
        }else{
            return null;
        }

        /*$photo = @stream_get_contents($this->photo);
        @fclose($this->photo);
        return base64_encode($photo);*/
    }

    public function setPhoto($photo): self
    {
        $this->photo = $photo;

        return $this;
    }
    /**
     * Get the value of plainPassword
     */ 
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * Set the value of plainPassword
     *
     * @return  self
     */ 
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;

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

