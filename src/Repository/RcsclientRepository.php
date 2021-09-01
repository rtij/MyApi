<?php

namespace App\Repository;

use App\Entity\Rcsclient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Rcsclient|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rcsclient|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rcsclient[]    findAll()
 * @method Rcsclient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RcsclientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rcsclient::class);
    }

    // /**
    //  * @return Rcsclient[] Returns an array of Rcsclient objects
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
    public function findOneBySomeField($value): ?Rcsclient
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
