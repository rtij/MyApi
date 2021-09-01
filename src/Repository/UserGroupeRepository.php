<?php

namespace App\Repository;

use App\Entity\Customer\Usergroupe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Usergroupe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Usergroupe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Usergroupe[]    findAll()
 * @method Usergroupe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserGroupeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Usergroupe::class);
    }

    // /**
    //  * @return Usergroupe[] Returns an array of Usergroupe objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Usergroupe
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
