<?php

namespace App\Repository;

use App\Entity\Statclient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Statclient|null find($id, $lockMode = null, $lockVersion = null)
 * @method Statclient|null findOneBy(array $criteria, array $orderBy = null)
 * @method Statclient[]    findAll()
 * @method Statclient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatclientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Statclient::class);
    }

    // /**
    //  * @return Statclient[] Returns an array of Statclient objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Statclient
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
