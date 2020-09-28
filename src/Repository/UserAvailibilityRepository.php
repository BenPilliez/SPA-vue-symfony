<?php

namespace App\Repository;

use App\Entity\UserAvailibility;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserAvailibility|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserAvailibility|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserAvailibility[]    findAll()
 * @method UserAvailibility[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserAvailibilityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserAvailibility::class);
    }

    // /**
    //  * @return UserAvailibility[] Returns an array of UserAvailibility objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserAvailibility
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
