<?php

namespace App\Repository;

use App\Entity\Niff;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Niff|null find($id, $lockMode = null, $lockVersion = null)
 * @method Niff|null findOneBy(array $criteria, array $orderBy = null)
 * @method Niff[]    findAll()
 * @method Niff[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NiffRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Niff::class);
    }

    // /**
    //  * @return Niff[] Returns an array of Niff objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Niff
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
