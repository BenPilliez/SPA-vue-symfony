<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserAvailibilityRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=UserAvailibilityRepository::class)
 */
class UserAvailibility
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("user:read")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("user:read")
     */
    private $morning;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("user:read")
     */
    private $midday;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("user:read")
     */
    private $evening;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("user:read")
     */
    private $night;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("user:read")
     */
    private $day;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="userAvailibilities")
     *
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMorning(): ?bool
    {
        return $this->morning;
    }

    public function setMorning(bool $morning): self
    {
        $this->morning = $morning;

        return $this;
    }

    public function getMidday(): ?bool
    {
        return $this->midday;
    }

    public function setMidday(bool $midday): self
    {
        $this->midday = $midday;

        return $this;
    }

    public function getEvening(): ?bool
    {
        return $this->evening;
    }

    public function setEvening(bool $evening): self
    {
        $this->evening = $evening;

        return $this;
    }

    public function getNight(): ?bool
    {
        return $this->night;
    }

    public function setNight(bool $night): self
    {
        $this->night = $night;

        return $this;
    }

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(string $day): self
    {
        $this->day = $day;

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
}
