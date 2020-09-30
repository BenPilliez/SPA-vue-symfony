<?php

declare(strict_types=1);

namespace App\Doctrine;

use Doctrine\Persistence\ObjectManager;
use Gesdinet\JWTRefreshTokenBundle\Entity\RefreshTokenRepository;
use Gesdinet\JWTRefreshTokenBundle\Model\RefreshTokenInterface;
use Gesdinet\JWTRefreshTokenBundle\Model\RefreshTokenManager as BaseRefreshTokenManager;

/**
 * Class RefreshTokenManager.
 */
class RefreshTokenManager extends BaseRefreshTokenManager
{
    protected  $objectManager;

    /**
     * @var class-string<mixed>
     */
    protected  $class;

    protected  $repository;

    /**
     * Constructor.
     *
     * @param class-string<mixed> $class
     */
    public function __construct(ObjectManager  $om, $class)
    {
        $this->objectManager = $om;

        $repo = $om->getRepository($class);
        assert($repo instanceof RefreshTokenRepository);
        $this->repository = $repo;

        $metadata = $om->getClassMetadata($class);

        /** @var class-string<mixed> $classString */
        $classString = $metadata->getName();
        $this->class = $classString;
    }

    /**
     * @param string $refreshToken
     *
     * @return ?RefreshTokenInterface
     */
    public function get($refreshToken): ?RefreshTokenInterface
    {
        $refreshToken = $this->repository->findOneBy(['refreshToken' => $refreshToken]);
        if ($refreshToken instanceof RefreshTokenInterface) {
            return $refreshToken;
        } else {
            return null;
        }
    }

    /**
     * @param string $username
     *
     * @return RefreshTokenInterface
     */
    public function getLastFromUsername($username): ?RefreshTokenInterface
    {
        $refreshToken = $this->repository->findOneBy(['username' => $username], ['valid' => 'DESC']);

        if ($refreshToken instanceof RefreshTokenInterface) {
            return $refreshToken;
        } else {
            return null;
        }
    }

    /**
     * @param bool|true $andFlush
     */
    public function save(RefreshTokenInterface $refreshToken, $andFlush = true): void
    {
        $this->objectManager->persist($refreshToken);

        if ($andFlush) {
            $this->objectManager->flush();
        }
    }

    /**
     * @param bool $andFlush
     */
    public function delete(RefreshTokenInterface $refreshToken, $andFlush = true): void
    {
        $this->objectManager->remove($refreshToken);

        if ($andFlush) {
            $this->objectManager->flush();
        }
    }

    /**
     * @param \DateTime $datetime
     * @param bool      $andFlush
     *
     * @return RefreshTokenInterface[]
     */
    public function revokeAllInvalid(?\DateTimeInterface $datetime = null, $andFlush = true)
    {
        /* @phpstan-ignore-next-line */
        $invalidTokens = $this->repository->findInvalid($datetime);

        foreach ($invalidTokens as $invalidToken) {
            $this->objectManager->remove($invalidToken);
        }

        if ($andFlush) {
            $this->objectManager->flush();
        }

        return $invalidTokens;
    }

    /**
     * Returns the RefreshToken fully qualified class name.
     *
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }
}