<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserConfigRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *
 * )
 * @ORM\Entity(repositoryClass=UserConfigRepository::class)
 */
class UserConfig
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user:read"})
     */
    private $cpu;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user:read"})
     */
    private $graphicCard;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user:read"})
     */
    private $ram;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user:read"})
     */
    private $screen;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user:read"})
     */
    private $mouse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user:read"})
     */
    private $keyboard;

    /**
     * @ORM\Column(type="json", nullable=true)
     * @Groups({"user:read"})
     */
    private $consoles = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user:read"})
     */
    private $motherboard;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user:read"})
     */
    private $power;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="userConfig", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCpu(): ?string
    {
        return $this->cpu;
    }

    public function setCpu(?string $cpu): self
    {
        $this->cpu = $cpu;

        return $this;
    }

    public function getGraphicCard(): ?string
    {
        return $this->graphicCard;
    }

    public function setGraphicCard(?string $graphicCard): self
    {
        $this->graphicCard = $graphicCard;

        return $this;
    }

    public function getRam(): ?string
    {
        return $this->ram;
    }

    public function setRam(?string $ram): self
    {
        $this->ram = $ram;

        return $this;
    }

    public function getScreen(): ?string
    {
        return $this->screen;
    }

    public function setScreen(?string $screen): self
    {
        $this->screen = $screen;

        return $this;
    }

    public function getMouse(): ?string
    {
        return $this->mouse;
    }

    public function setMouse(?string $mouse): self
    {
        $this->mouse = $mouse;

        return $this;
    }

    public function getKeyboard(): ?string
    {
        return $this->keyboard;
    }

    public function setKeyboard(?string $keyboard): self
    {
        $this->keyboard = $keyboard;

        return $this;
    }

    public function getConsoles(): ?array
    {
        return $this->consoles;
    }

    public function setConsoles(?array $consoles): self
    {
        $this->consoles = $consoles;

        return $this;
    }

    public function getMotherboard(): ?string
    {
        return $this->motherboard;
    }

    public function setMotherboard(?string $motherboard): self
    {
        $this->motherboard = $motherboard;

        return $this;
    }

    public function getPower(): ?string
    {
        return $this->power;
    }

    public function setPower(?string $power): self
    {
        $this->power = $power;

        return $this;
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
}
