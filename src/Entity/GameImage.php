<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\GameImageRepository;
use App\Controller\Games\CreateMediaObjectAction;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use App\Controller\Games\DeleteMediaObjectAction;

/**
 * @ApiResource(
 *          iri="http://schema.org/ImageObject",
 *     collectionOperations={"get"={"validation_groups"={"Default", "media_object_read"}},
 *     "post"={
 *             "controller"=CreateMediaObjectAction::class,
 *             "deserialize"=false,
 *             "security"="is_granted('ROLE_ADMIN')",
 *             "validation_groups"={"Default", "media_object_create"},
 *             "openapi_context"={
 *                 "requestBody"={
 *                     "content"={
 *                         "multipart/form-data"={
 *                             "schema"={
 *                                 "type"="object",
 *                                 "properties"={
 *                                     "file"={
 *                                         "type"="string",
 *                                         "format"="binary"
 *                                     }
 *                                 }
 *                             }
 *                         }
 *                     }
 *                 }
 *             }
 *         }},
 *     itemOperations={"get","delete"={
 *     "controller"=DeleteMediaObjectAction::class,
}}
 * )
 * @Vich\Uploadable
 * @ORM\Entity(repositoryClass=GameImageRepository::class)
 */
class GameImage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("game:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @ApiProperty(iri="http://schema.org/contentUrl")
     * @Groups({"game:read", "game:write"})
     */
    public $contentUrl;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:read","game:read", "game:write"})
     */
    private $filePath;

    /**
     * @var File|null
     *
     * @Assert\NotNull(groups={"media_object_create","media_object_update"})
     * @Vich\UploadableField(mapping="games", fileNameProperty="filePath")
     * @Groups({"game:read","game:write"})
     */
    public $file;


    /**
     * @ORM\OneToOne(targetEntity=Game::class, inversedBy="gameImage", cascade={"persist"})
     */
    private $game;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContentUrl(): ?string
    {
        return $this->contentUrl;
    }

    public function setContentUrl(?string $contentUrl): self
    {
        $this->contentUrl = $contentUrl;

        return $this;
    }

    public function getFilePath(): ?string
    {
        return $this->filePath;
    }

    public function setFilePath(string $filePath): self
    {
        $this->filePath = $filePath;

        return $this;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): self
    {
        $this->game = $game;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
