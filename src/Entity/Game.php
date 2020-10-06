<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\GameRepository;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     attributes={"pagination_client_items_per_page"=true},
 *     normalizationContext={"groups"={"game:read"}},
 *     denormalizationContext={"groups"={"game:write"}},
 * )
 * @ApiFilter(RangeFilter::class, properties={"rate"})
 *
 * @ORM\Entity(repositoryClass=GameRepository::class)
 */
class Game
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"game:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"game:read","game:read"})
     */
    private $name;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"game:read","game:write"})
     */
    private $rate;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"game:read","game:write"})
     */
    private $text;

    /**
     * @ORM\OneToOne(targetEntity=GameImage::class, mappedBy="game", cascade={"persist", "remove"})
     * @Groups({"game:read","game:write", "media_object_read"})
     */
    private $gameImage;

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

    public function getRate(): ?float
    {
        return $this->rate;
    }

    public function setRate(?float $rate): self
    {
        $this->rate = $rate;

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
}
