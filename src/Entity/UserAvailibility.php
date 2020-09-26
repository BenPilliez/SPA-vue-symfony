<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserAvailibilityRepository;
use APP\Controller\Availibilities\GetAvailibilitesController;
use App\Controller\Availibilities\CreateAvailibilitesController;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"dispo:read"}},
 *     denormalizationContext={"groups"={"dispo:write"}},
 *     collectionOperations={
 *       "post" ={
 *         "controller"=CreateAvailibilitesController::class
 *     }
 *     },
 *     itemOperations={ "get",
 *     "update_availibilities"= {
 *     "route_name"="availibility_update",
 *     "method"="PUT",
 *     },}
 * )
 * @ORM\Entity(repositoryClass=UserAvailibilityRepository::class)
 */
class UserAvailibility
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @ApiProperty(identifier=false)
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"dispo:read", "user:read","dispo:write"})
     */
    private $morning = false;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"dispo:read", "user:read","dispo:write"})
     */
    private $midday = false;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"dispo:read", "user:read","dispo:write"})
     */
    private $evening = false;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"dispo:read", "user:read","dispo:write"})
     */
    private $night = false;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"dispo:read", "user:read","dispo:write"})
     */
    private $day;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="userAvailibilities")
     * @Groups({"dispo:read","dispo:write"})
     * @ApiProperty(identifier=true)
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
