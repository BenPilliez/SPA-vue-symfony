<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\SerializedName;
use App\Repository\UserRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ApiResource(
 *     normalizationContext={"groups"={"user:read"}},
 *     denormalizationContext={"groups"={"user:write"}},
 *     collectionOperations={
 *       "post"={"security"="is_granted('IS_AUTHENTICATED_ANONYMOUSLY')"},
 *         "get"
 *     },
 *      itemOperations={"get","put","delete"},
 * )
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository", repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"username"},
 * message="Le pseudonyme ou email est déjà associé à un compte")
 *
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("user:read")
     * @ApiProperty(identifier=true)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"user:read", "user:write"})
     * @Assert\NotBlank(
     *     message="Le champ pseudonyme ne peut être vide"
     * )
     */
    private $username;

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
     * @Groups("user:write")
     * @SerializedName("password")
     */
    private $plainPassword;

    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     * @return User
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:read", "user:write"})
     * @Assert\Email(
     *     message= "Oula mais ce n'est pas un email valide ça !"
     * )
     * @Assert\NotBlank(
     *     message="Il nous faut un email !"
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user:read", "user:write"})
     */
    private $gender;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"user:read", "user:write"})
     * @Assert\Date(
     *     message="T'es sûr que c'est une date ?"
     * )
     */
    private $birthday;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"user:read", "user:write"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user:read", "user:write"})
     * @Assert\Length(
     *     max=255,
     *     maxMessage="Oula mais ça fait plus que 255 caractères ça !"
     * )
     */
    private $slogan;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"user:read", "user:write"})
     */
    private $isVerified;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user:read", "user:write"})
     */
    private $gamerType;

    /**
     * @ORM\Column(type="json", nullable=true)
     * @Groups({"user:read", "user:write"})
     */
    private $languages = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user:read", "user:write"})
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user:read", "user:write"})
     */
    private $gameRegion;

    /**
     * @var
     * @Groups({"user:read"})
     */
    private $age;

    /**
     * @ORM\OneToMany(targetEntity=UserPlatform::class, mappedBy="user", orphanRemoval=true)
     * @Groups({"user:read", "user_platform:read"})
     */
    private $userPlatforms;

    /**
     * @ORM\OneToOne(targetEntity=UserConfig::class, mappedBy="user", cascade={"persist", "remove"})
     * @Groups("user:read")
     */
    private $userConfig;

    public function __construct()
    {
        $this->updatedAt = new DateTime();
        $this->createdAt = new DateTime();
        $this->isVerified = false;
        $this->userPlatforms = new ArrayCollection();
    }

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
        return (string)$this->username;
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
        $roles[] = 'ROLE_USER';

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
        return (string)$this->password;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getBirthday(): ?DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(?DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSlogan(): ?string
    {
        return $this->slogan;
    }

    public function setSlogan(?string $slogan): self
    {
        $this->slogan = $slogan;

        return $this;
    }

    public function getIsVerified(): ?bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getGamerType(): ?string
    {
        return $this->gamerType;
    }

    public function setGamerType(?string $gamerType): self
    {
        $this->gamerType = $gamerType;

        return $this;
    }

    public function getLanguages(): ?array
    {
        return $this->languages;
    }

    public function setLanguages(array $languages): self
    {
        $this->languages = $languages;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getGameRegion(): ?string
    {
        return $this->gameRegion;
    }

    public function setGameRegion(?string $gameRegion): self
    {
        $this->gameRegion = $gameRegion;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAge(): ?string
    {

        if ($this->birthday === null) {
            return null;
        }

        $now = date("Y-m-d");
        $age = date_diff($this->birthday, date_create($now));
        $this->age = $age->format('%y');

        return $this->age;
    }

    /**
     * @return Collection|UserPlatform[]
     */
    public function getUserPlatforms(): Collection
    {
        return $this->userPlatforms;
    }

    public function addUserPlatform(UserPlatform $userPlatform): self
    {
        if (!$this->userPlatforms->contains($userPlatform)) {
            $this->userPlatforms[] = $userPlatform;
            $userPlatform->setUser($this);
        }

        return $this;
    }

    public function removeUserPlatform(UserPlatform $userPlatform): self
    {
        if ($this->userPlatforms->contains($userPlatform)) {
            $this->userPlatforms->removeElement($userPlatform);
            // set the owning side to null (unless already changed)
            if ($userPlatform->getUser() === $this) {
                $userPlatform->setUser(null);
            }
        }

        return $this;
    }

    public function getUserConfig(): ?UserConfig
    {
        return $this->userConfig;
    }

    public function setUserConfig(UserConfig $userConfig): self
    {
        $this->userConfig = $userConfig;

        // set the owning side of the relation if necessary
        if ($userConfig->getUser() !== $this) {
            $userConfig->setUser($this);
        }

        return $this;
    }
}