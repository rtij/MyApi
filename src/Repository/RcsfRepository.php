<?php

namespace App\Repository;

use App\Entity\Rcsf;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Rcsf|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rcsf|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rcsf[]    findAll()
 * @method Rcsf[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RcsfRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rcsf::class);
    }

    // /**
    //  * @return Rcsf[] Returns an array of Rcsf objects
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
    public function findOneBySomeField($value): ?Rcsf
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
