<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\GameRepository;
use App\Filter\rateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     attributes={"pagination_client_items_per_page"=true,
 *     "pagination_client_enabled"=true},
 *     normalizationContext={"groups"={"game:read"}},
 *     denormalizationContext={"groups"={"game:write"}},
 *     collectionOperations={
"get","post"
 *     },
 *     itemOperations={
"removeFromLibrary"={
 *      "route_name"="delete_from_library",
 *     "method"="PATCH",
 *     },
 *     "addToLibrary"={
 *      "route_name"="add_to_library",
 *     "method"="POST"
 *     },
 *     "get","put","delete"
 *     }
 * )
 * @ApiFilter(rateFilter::class)
 * @ApiFilter(SearchFilter::class, properties={"name":"partial"})
 *
 * @ORM\Entity(repositoryClass=GameRepository::class)
 */
class Game
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"user:read","game:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:read","game:read","game:write"})
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"user:read","game:read","game:write"})
     */
    private $text;

    /**
     * @ORM\OneToOne(targetEntity=GameImage::class, mappedBy="game", cascade={"persist", "remove"})
     * @Groups({"user:read","game:read","game:write", "media_object_read"})
     */
    private $gameImage;

    /**
     * @ORM\OneToOne(targetEntity=RateGame::class, mappedBy="game", cascade={"persist", "remove"})
     * @Groups({"game:read"})
     */
    private $rates;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="games")
     * @ApiSubresource
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
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

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getGameImage(): ?GameImage
    {
        return $this->gameImage;
    }

    public function setGameImage(?GameImage $gameImage): self
    {
        $this->gameImage = $gameImage;

        // set (or unset) the owning side of the relation if necessary
        $newGame = null === $gameImage ? null : $this;
        if ($gameImage->getGame() !== $newGame) {
            $gameImage->setGame($newGame);
        }

        return $this;
    }

    public function getRates(): ?RateGame
    {
        return $this->rates;
    }

    public function setRates(RateGame $rates): self
    {
        $this->rates = $rates;

        // set the owning side of the relation if necessary
        if ($rates->getGame() !== $this) {
            $rates->setGame($this);
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
        }

        return $this;
    }


}
