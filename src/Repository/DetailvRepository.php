<?php

namespace App\Repository;

use App\Entity\Detailv;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Detailv|null find($id, $lockMode = null, $lockVersion = null)
 * @method Detailv|null findOneBy(array $criteria, array $orderBy = null)
 * @method Detailv[]    findAll()
 * @method Detailv[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetailvRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Detailv::class);
    }
    public function findByNumvAndIdprodAndCoded($value1,$value2,$value3)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.numv = :val1')
            ->setParameter('val1', $value1)
            ->andWhere('d.idprod = :val2')
            ->setParameter('val2', $value2)
            ->andWhere('d.coded = :val3')
            ->setParameter('val3', $value3)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    // /**
    //  * @return Detailv[] Returns an array of Detailv objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Detailv
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
