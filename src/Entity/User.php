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
 *    attributes={"pagination_client_enabled"=true,
 *     "pagination_client_items_per_page"=true},
 *     collectionOperations={
 *     "post"={
 *     "security"="is_granted('IS_AUTHENTICATED_ANONYMOUSLY')",
 *      "groups"={"Default","create"}
 *          },
 *         "get"
 *     },
 *      itemOperations={"get","put" ={
 *     "security"="is_granted('ROLE_USER') and object == user",
 *     "security_message"="Petit coquin c'est pas ton compte ça "
 * },
 *     "update_password"= {
 *     "route_name"="password_update",
 *     "method"="PUT",
 *     "security"="is_granted('ROLE_USER') and object == user",
 *     "security_message"="Petit coquin c'est pas ton compte ça ",
 *     },
 *     "delete"},
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
     * @Assert\Regex(
     *     pattern="/^[a-zA-Z0-9]*$/",
     *     message="Ton pseudo  ne
     *          peut contentir d'émojies, d'espaces ou de cartères spéciaux"
     * )
     * @Assert\Length(
     *     min= "4",
     *     max="20",
     *     minMessage="Ton pseudo doit faire au moin 4 caractères",
     *     maxMessage="Ton pseudo ne peut faire plus de 20 caractères"
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
     * @Assert\Regex(
     *     pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\?<>\{\}\[\]\(\)\$%\^&\*])(?=.{8,})/",
     *     message="Ton mot de passe doit comprendre 4 caractères minimum et 2O max, il doit contenir
    des lettres, au moins un chiffre et un caractère spécial, mais ni d'espace ou d'émojies"
     * )
     * @Assert\NotBlank(
     *     groups="create",
     *     message="Oula, il te faut un mot de passe"
     * )
     * @Assert\Length(
     *     min="8",
     *     max="20",
     *     minMessage="Ton mot de passe doit faire au moin 8 caractères",
     *     maxMessage="Ton mot de passe ne peut faire plus de 20 caractères"
     * )
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
     * @ORM\OneToOne(targetEntity=UserConfig::class, mappedBy="user", cascade={"persist", "remove"})
     * @Groups("user:read")
     */
    private $userConfig;

    /**
     * @ORM\OneToOne(targetEntity=UserPlatform::class, mappedBy="user", cascade={"persist", "remove"})
     * @Groups("user:read")
     */
    private $userPlatform;

    /**
     * @ORM\OneToOne(targetEntity=Registration::class, mappedBy="user", cascade={"persist", "remove"})
     */
    private $userRegistration;

    /**
     * @return mixed
     */
    public function getUserPlatform()
    {
        return $this->userPlatform;
    }

    /**
     * @param mixed $userPlatform
     * @return User
     */
    public function setUserPlatform($userPlatform)
    {
        $this->userPlatform = $userPlatform;
        return $this;
    }

    /**
     * @ORM\OneToMany(targetEntity=UserAvailibility::class, mappedBy="user",cascade={"persist", "remove"})
     * @Groups("user:read")
     */
    private $userAvailibilities;

    /**
     * @ORM\OneToMany(targetEntity=MediaObject::class, mappedBy="user",cascade={"persist", "remove"})
     * @Groups("user:read")
     */
    private $mediaObjects;


    public function __construct()
    {
        $this->updatedAt = new DateTime();
        $this->createdAt = new DateTime();
        $this->isVerified = false;
        $this->userPlatforms = new ArrayCollection();
        $this->userAvailibilities = new ArrayCollection();
        $this->mediaObjects = new ArrayCollection();
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

    public function getUserAvailibility(): ?UserAvailibility
    {
        return $this->userAvailibility;
    }

    public function setUserAvailibility(UserAvailibility $userAvailibility): self
    {
        $this->userAvailibility = $userAvailibility;

        // set the owning side of the relation if necessary
        if ($userAvailibility->getUser() !== $this) {
            $userAvailibility->setUser($this);
        }

        return $this;
    }

    /**
     * @return Collection|UserAvailibility[]
     */
    public function getUserAvailibilities(): Collection
    {
        return $this->userAvailibilities;
    }

    public function addUserAvailibility(UserAvailibility $userAvailibility): self
    {
        if (!$this->userAvailibilities->contains($userAvailibility)) {
            $this->userAvailibilities[] = $userAvailibility;
            $userAvailibility->setUser($this);
        }

        return $this;
    }

    public function removeUserAvailibility(UserAvailibility $userAvailibility): self
    {
        if ($this->userAvailibilities->contains($userAvailibility)) {
            $this->userAvailibilities->removeElement($userAvailibility);
            // set the owning side to null (unless already changed)
            if ($userAvailibility->getUser() === $this) {
                $userAvailibility->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MediaObject[]
     */
    public function getMediaObjects(): Collection
    {
        return $this->mediaObjects;
    }

    public function addMediaObject(MediaObject $mediaObject): self
    {
        if (!$this->mediaObjects->contains($mediaObject)) {
            $this->mediaObjects[] = $mediaObject;
            $mediaObject->setUser($this);
        }

        return $this;
    }

    public function removeMediaObject(MediaObject $mediaObject): self
    {
        if ($this->mediaObjects->contains($mediaObject)) {
            $this->mediaObjects->removeElement($mediaObject);
            // set the owning side to null (unless already changed)
            if ($mediaObject->getUser() === $this) {
                $mediaObject->setUser(null);
            }
        }

        return $this;
    }
}