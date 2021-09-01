<?php

namespace App\Repository;

use App\Entity\Customer\Authtoken;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Authtoken|null find($id, $lockMode = null, $lockVersion = null)
 * @method Authtoken|null findOneBy(array $criteria, array $orderBy = null)
 * @method Authtoken[]    findAll()
 * @method Authtoken[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuthTokenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Authtoken::class);
    }

    public function findExpired($value1,$value2)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.createdat != :val1')
            ->setParameter('val1', $value1)
            ->andWhere('a.iduser = :val')
            ->setParameter('val', $value2)
            ->getQuery()
            ->getResult()
        ;
    }
    
    // /**
    //  * @return Authtoken[] Returns an array of Authtoken objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Authtoken
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
