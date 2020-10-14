<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\RateGameRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *      normalizationContext={"groups"={"rate:read"}},
 *     denormalizationContext={"groups"={"rate:write"}},
 * )
 * @ORM\Entity(repositoryClass=RateGameRepository::class)
 */
class RateGame
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"game:read","rate:read","rate:write"})
     */
    private $nbRate;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"game:read","rate:read","rate:write"})
     */
    private $rate;

    /**
     * @ORM\OneToOne(targetEntity=Game::class, inversedBy="rates", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"rate:read", "rate:write"})
     */
    private $game;


    /**
     * @param $rate
     * @param $nb_rate
     * @return float|int
     * @Groups({"game:read","rate:read"})
     */
    public function getCalculatedRate() : float
    {
        return $this->rate / $this->nbRate;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbRate(): ?int
    {
        return $this->nbRate;
    }

    public function setNbRate(int $nbRate): self
    {
        $this->nbRate = $nbRate;

        return $this;
    }

    public function getRate(): ?string
    {
        return $this->rate;
    }

    public function setRate(string $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): self
    {
        $this->game = $game;

        // set (or unset) the owning side of the relation if necessary
        $newRates = null === $game ? null : $this;
        if ($game->getRates() !== $newRates) {
            $game->setRates($newRates);
        }

        return $this;
    }
}
