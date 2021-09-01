<?php

namespace App\Repository;

use App\Entity\Statf;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Statf|null find($id, $lockMode = null, $lockVersion = null)
 * @method Statf|null findOneBy(array $criteria, array $orderBy = null)
 * @method Statf[]    findAll()
 * @method Statf[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatfRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Statf::class);
    }

    // /**
    //  * @return Statf[] Returns an array of Statf objects
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
    public function findOneBySomeField($value): ?Statf
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
