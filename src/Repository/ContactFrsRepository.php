<?php

namespace App\Repository;

use App\Entity\Contactfrs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Detaila|null find($id, $lockMode = null, $lockVersion = null)
 * @method Detaila|null findOneBy(array $criteria, array $orderBy = null)
 * @method Detaila[]    findAll()
 * @method Detaila[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactFrsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contactfrs::class);
    }

    
    public function findByIdcontactAndIdf($value1,$value2)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.numa = :val1')
            ->andWhere('d.idprod = :val2')
            ->setParameter('val1', $value1)
            ->setParameter('val2', $value2)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    // /**
    //  * @return ContactFrs[] Returns an array of Detaila objects
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
    public function findOneBySomeField($value): ?Detaila
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
