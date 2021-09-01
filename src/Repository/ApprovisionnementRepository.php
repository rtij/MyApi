<?php

namespace App\Repository;

use App\Entity\Approvisionnement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Approvisionnement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Approvisionnement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Approvisionnement[]    findAll()
 * @method Approvisionnement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApprovisionnementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Approvisionnement::class);
    }
    public function findApprovisionnement(){
        
        $sql = "SELECT a.numa,a.idprod,a.qtea,a.qtep FROM App:Approvisionnement a
        ";
        return $this->getEntityManager()->createQuery($sql)
        ->getResult();
    }
    public function findAppro()
    {
        return $this->createQueryBuilder('d')
            ->orderBy('d.numa', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
    // /**
    //  * @return Approvisionnement[] Returns an array of Approvisionnement objects
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
