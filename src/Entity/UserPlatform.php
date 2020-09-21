<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserPlatformRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"user_platform:read"}, "swagger_definition_name"="Read"},
 *     denormalizationContext={"groups"={"user_platform:write"}, "swagger_definition_name"="Write"},
 * )
 * @ORM\Entity(repositoryClass=UserPlatformRepository::class)
 */
class UserPlatform
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user_platform:read", "user_platform:write", "user:read"})
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user_platform:read", "user_platform:write", "user:read"})
     */
    private $username;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="userPlatforms")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Platform::class, inversedBy="userPlatforms")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"user_platform:read","user:read"})
     */
    private $platform;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->username;
    }

    public function setName(?string $name): self
    {
        $this->username = $name;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getPlatform(): ?Platform
    {
        return $this->platform;
    }

    public function setPlatform(?Platform $platform): self
    {
        $this->platform = $platform;

        return $this;
    }
}
