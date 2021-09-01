<?php

namespace App\Repository;

use App\Entity\Ventepaiement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ventepaiement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ventepaiement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ventepaiement[]    findAll()
 * @method Ventepaiement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VentepaiementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ventepaiement::class);
    }

    // /**
    //  * @return Ventepaiement[] Returns an array of Ventepaiement objects
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
    public function findOneBySomeField($value): ?Ventepaiement
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
