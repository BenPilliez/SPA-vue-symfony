<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\FriendshipRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Filter\friendsFilter;
/**
 * @ApiResource(
 *     normalizationContext={"groups"={"friend:read"}},
 *     denormalizationContext={"groups"={"friend:write"}}
 * )
 * @ApiFilter(friendsFilter::class)
 * @ORM\Entity(repositoryClass=FriendshipRepository::class)
 */
class Friendship
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="friends")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"friend:read","friend:write"})
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="friendsWithMe")
     * @ORM\JoinColumn(nullable=false)
     *   @Groups({"friend:read","friend:write"})
     */
    private $friend;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     *  @Groups({"friend:read","friend:write"})
     */
    private $accept;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getFriend(): ?User
    {
        return $this->friend;
    }

    public function setFriend(?User $friend): self
    {
        $this->friend = $friend;

        return $this;
    }

    public function getAccept(): ?bool
    {
        return $this->accept;
    }

    public function setAccept(?bool $accept): self
    {
        $this->accept = $accept;

        return $this;
    }
}