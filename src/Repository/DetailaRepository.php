<?php

namespace App\Repository;

use App\Entity\Achat;
use App\Entity\Detaila;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Detaila|null find($id, $lockMode = null, $lockVersion = null)
 * @method Detaila|null findOneBy(array $criteria, array $orderBy = null)
 * @method Detaila[]    findAll()
 * @method Detaila[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetailaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Detaila::class);
    }
    
    public function FindDetaila()
    {
        $sql = "SELECT a.numa, a.mont,p.montantp
        FROM App:Montantachat a
        LEFT JOIN App:Paiementachat p
        WITH p.numa=a.numa
        GROUP BY a.numa
        ORDER BY a.numa DESC
        ";
        return $this->getEntityManager()->createQuery($sql)
        ->getResult();
    }
    
    public function findByIdProdAndNumA($value1,$value2)
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
    public function findPaiement()
    {
        return $this->createQueryBuilder('m')
            ->select('m')
            ->from('Montantachat', 'm')
            ->getQuery()
            ->getOneOrNullResult()
        ;
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
