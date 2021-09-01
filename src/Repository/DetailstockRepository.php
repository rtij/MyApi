<?php

namespace App\Repository;

use App\Entity\Detailstock;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Detailstock|null find($id, $lockMode = null, $lockVersion = null)
 * @method Detailstock|null findOneBy(array $criteria, array $orderBy = null)
 * @method Detailstock[]    findAll()
 * @method Detailstock[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetailstockRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Detailstock::class);
    }

    public function findByIdprodAndCodeD($value1,$value2)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.idprod = :val1')
            ->andWhere('d.codedepot = :val2')
            ->setParameter('val1', $value1)
            ->setParameter('val2', $value2)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    
    public function findOtherByIdprodAndCodeD($value1,$value2)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.idprod = :val1')
            ->andWhere('d.codedepot != :val2')
            ->setParameter('val1', $value1)
            ->setParameter('val2', $value2)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function Liste()
    {
        $sql="SELECT d.idprod,d.coded,d.qtep FROM App:Detailstock d";
        return $this->getEntityManager()->createQuery($sql)
        ->getResult();
    }

    // /**
    //  * @return Detailstock[] Returns an array of Detailsock objects
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
    public function findOneBySomeField($value): ?Detailsock
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
