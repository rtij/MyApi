<?php

namespace App\Repository;

use App\Entity\Nifclient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Nifclient|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nifclient|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nifclient[]    findAll()
 * @method Nifclient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NifclientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Nifclient::class);
    }

    // /**
    //  * @return Nifclient[] Returns an array of Nifclient objects
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
    public function findOneBySomeField($value): ?Nifclient
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
