<?php

namespace App\Repository;

use App\Entity\Ajoutstock;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cifclient|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cifclient|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cifclient[]    findAll()
 * @method Cifclient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AjoutStockRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ajoutstock::class);
    }
   
    public function findByNumaAndIdprod($value1,$value2)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.idprod = :val1')
            ->andWhere('c.numa = :val2')
            ->setParameter('val1', $value1)
            ->setParameter('val2', $value2)
            ->getQuery()
            ->getResult()
        ;
    }
    public function findByExampleField($value1,$value2,$value3)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.idprod = :val1')
            ->andWhere('c.coded = :val2')
            ->andWhere('c.numa = :val3')
            ->setParameter('val1', $value1)
            ->setParameter('val2', $value2)
            ->setParameter('val3', $value3)
            ->orderBy('c.numa', 'DESC')
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    // /**
    //  * @return Cifclient[] Returns an array of Cifclient objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Cifclient
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
