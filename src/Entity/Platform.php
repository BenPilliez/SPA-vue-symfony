<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PlatformRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"platform:read"}, "swagger_definition_name"="Read"},
 *     denormalizationContext={"groups"={"platform:write"}, "swagger_definition_name"="Write"},
 * )
 * @ORM\Entity(repositoryClass=PlatformRepository::class)
 */
class Platform
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:read","user_platform:read","platform:read","platform:write"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:read","user_platform:read","platform:read","platform:write"})
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:read","user_platform:read","platform:read","platform:write"})
     */
    private $displayName;

    /**
     * @ORM\OneToMany(targetEntity=UserPlatform::class, mappedBy="platform", orphanRemoval=true)
     */
    private $userPlatforms;

    public function __construct()
    {
        $this->userPlatforms = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    public function setDisplayName(string $displayName): self
    {
        $this->displayName = $displayName;

        return $this;
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
            $userPlatform->setPlatform($this);
        }

        return $this;
    }

    public function removeUserPlatform(UserPlatform $userPlatform): self
    {
        if ($this->userPlatforms->contains($userPlatform)) {
            $this->userPlatforms->removeElement($userPlatform);
            // set the owning side to null (unless already changed)
            if ($userPlatform->getPlatform() === $this) {
                $userPlatform->setPlatform(null);
            }
        }

        return $this;
    }
}
