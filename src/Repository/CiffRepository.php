<?php

namespace App\Repository;

use App\Entity\Ciff;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ciff|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ciff|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ciff[]    findAll()
 * @method Ciff[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CiffRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ciff::class);
    }

    // /**
    //  * @return Ciff[] Returns an array of Ciff objects
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
    public function findOneBySomeField($value): ?Ciff
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
