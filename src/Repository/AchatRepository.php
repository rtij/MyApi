<?php

namespace App\Repository;

use App\Entity\Achat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Detaila|null find($id, $lockMode = null, $lockVersion = null)
 * @method Detaila|null findOneBy(array $criteria, array $orderBy = null)
 * @method Detaila[]    findAll()
 * @method Detaila[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AchatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Achat::class);
    }
    
    public function OrderByDate()
    {
        return $this->createQueryBuilder('d')
            ->orderBy('d.datea', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
    
    public function findMax()
    {
        $sql = "SELECT MAX(a.numa) AS id FROM App:Achat a";
        return $this->getEntityManager()->createQuery($sql)
        ->getOneOrNullResult();
    }
    // /**
    //  * @return Detaila[] Returns an array of Detaila objects
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
