<?php

namespace App\Repository;

use App\Entity\Montantachat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Montantachat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Montantachat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Montantachat[]    findAll()
 * @method Montantachat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MontantachatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Montantachat::class);
    }

    // /**
    //  * @return Montantachat[] Returns an array of Montantachat objects
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
    public function findOneBySomeField($value): ?Montantachat
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
