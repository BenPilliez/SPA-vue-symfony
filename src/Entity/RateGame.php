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
     */
    private $nb_rate;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     * @Groups({"game:read","rate:read"})
     */
    private $rate;

    /**
     * @param $rate
     * @param $nb_rate
     * @return float|int
     * @Groups({"game:read","rate:read"})
     */
    public function getCalculatedRate() : float
    {
        return $this->rate / $this->nb_rate;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbRate(): ?int
    {
        return $this->nb_rate;
    }

    public function setNbRate(int $nb_rate): self
    {
        $this->nb_rate = $nb_rate;

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
}
