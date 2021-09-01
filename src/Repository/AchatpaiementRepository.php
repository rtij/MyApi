<?php

namespace App\Repository;

use App\Entity\Achatpaiement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NativeQuery;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Achatpaiement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Achatpaiement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Achatpaiement[]    findAll()
 * @method Achatpaiement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AchatpaiementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Achatpaiement::class);
    }

    // /**
    //  * @return Achatpaiement[] Returns an array of Achatpaiement objects
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
    public function findOneBySomeField($value): ?Achatpaiement
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
