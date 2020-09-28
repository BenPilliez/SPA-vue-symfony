<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserPlatformRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={
 *      "post"={"security"="is_granted('ROLE_USER') and object == user",}
 *     }
 * )
 * @ORM\Entity(repositoryClass=UserPlatformRepository::class)
 */
class UserPlatform
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("user:read")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     *
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("user:read")
     */
    private $steam;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("user:read")
     */
    private $facebook;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("user:read")
     */
    private $battlenet;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("user:read")
     */
    private $gog;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("user:read")
     */
    private $instagram;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("user:read")
     */
    private $lol;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("user:read")
     */
    private $nintendo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("user:read")
     */
    private $origin;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("user:read")
     */
    private $psn;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("user:read")
     */
    private $rockstar;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("user:read")
     */
    private $skype;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("user:read")
     */
    private $snapchat;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("user:read")
     */
    private $twitch;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("user:read")
     */
    private $twitter;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("user:read")
     */
    private $ubisoft;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("user:read")
     */
    private $wargaming;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("user:read")
     */
    private $xbox;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("user:read")
     */
    private $youtube;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getSteam(): ?string
    {
        return $this->steam;
    }

    public function setSteam(?string $steam): self
    {
        $this->steam = $steam;

        return $this;
    }

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function setFacebook(?string $facebook): self
    {
        $this->facebook = $facebook;

        return $this;
    }

    public function getBattlenet(): ?string
    {
        return $this->battlenet;
    }

    public function setBattlenet(?string $battlenet): self
    {
        $this->battlenet = $battlenet;

        return $this;
    }

    public function getGog(): ?string
    {
        return $this->gog;
    }

    public function setGog(?string $gog): self
    {
        $this->gog = $gog;

        return $this;
    }

    public function getInstagram(): ?string
    {
        return $this->instagram;
    }

    public function setInstagram(?string $instagram): self
    {
        $this->instagram = $instagram;

        return $this;
    }

    public function getLol(): ?string
    {
        return $this->lol;
    }

    public function setLol(?string $lol): self
    {
        $this->lol = $lol;

        return $this;
    }

    public function getNintendo(): ?string
    {
        return $this->nintendo;
    }

    public function setNintendo(?string $nintendo): self
    {
        $this->nintendo = $nintendo;

        return $this;
    }

    public function getOrigin(): ?string
    {
        return $this->origin;
    }

    public function setOrigin(?string $origin): self
    {
        $this->origin = $origin;

        return $this;
    }

    public function getPsn(): ?string
    {
        return $this->psn;
    }

    public function setPsn(?string $psn): self
    {
        $this->psn = $psn;

        return $this;
    }

    public function getRockstar(): ?string
    {
        return $this->rockstar;
    }

    public function setRockstar(?string $rockstar): self
    {
        $this->rockstar = $rockstar;

        return $this;
    }

    public function getSkype(): ?string
    {
        return $this->skype;
    }

    public function setSkype(?string $skype): self
    {
        $this->skype = $skype;

        return $this;
    }

    public function getSnapchat(): ?string
    {
        return $this->snapchat;
    }

    public function setSnapchat(?string $snapchat): self
    {
        $this->snapchat = $snapchat;

        return $this;
    }

    public function getTwitch(): ?string
    {
        return $this->twitch;
    }

    public function setTwitch(?string $twitch): self
    {
        $this->twitch = $twitch;

        return $this;
    }

    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    public function setTwitter(?string $twitter): self
    {
        $this->twitter = $twitter;

        return $this;
    }

    public function getUbisoft(): ?string
    {
        return $this->ubisoft;
    }

    public function setUbisoft(?string $ubisoft): self
    {
        $this->ubisoft = $ubisoft;

        return $this;
    }

    public function getWargaming(): ?string
    {
        return $this->wargaming;
    }

    public function setWargaming(?string $wargaming): self
    {
        $this->wargaming = $wargaming;

        return $this;
    }

    public function getXbox(): ?string
    {
        return $this->xbox;
    }

    public function setXbox(?string $xbox): self
    {
        $this->xbox = $xbox;

        return $this;
    }

    public function getYoutube(): ?string
    {
        return $this->youtube;
    }

    public function setYoutube(?string $youtube): self
    {
        $this->youtube = $youtube;

        return $this;
    }
}
