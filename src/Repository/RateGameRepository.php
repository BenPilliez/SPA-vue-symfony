<?php

namespace App\Repository;

use App\Entity\RateGame;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RateGame|null find($id, $lockMode = null, $lockVersion = null)
 * @method RateGame|null findOneBy(array $criteria, array $orderBy = null)
 * @method RateGame[]    findAll()
 * @method RateGame[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RateGameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RateGame::class);
    }

    // /**
    //  * @return RateGame[] Returns an array of RateGame objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RateGame
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
