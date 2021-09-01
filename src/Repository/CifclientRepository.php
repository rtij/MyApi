<?php

namespace App\Repository;

use App\Entity\Cifclient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cifclient|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cifclient|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cifclient[]    findAll()
 * @method Cifclient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CifclientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cifclient::class);
    }

    // /**
    //  * @return Cifclient[] Returns an array of Cifclient objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Cifclient
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
