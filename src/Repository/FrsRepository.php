<?php

namespace App\Repository;

use App\Entity\Frs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Frs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Frs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Frs[]    findAll()
 * @method Frs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FrsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Frs::class);
    }

    // /**
    //  * @return Frs[] Returns an array of Frs objects
    //  */

    public function FindNonSup()
    {
        $sql = "SELECT f.idf,f.nomf,f.adrf,f.emailf,n.niff,r.rcsf,ci.ciff,s.statf,f.frsSup 
        FROM App:Frs f
        LEFT JOIN App:Rcsf r
        WITH f.idf = r.idf
        LEFT JOIN  App:Ciff ci
        WITH f.idf = ci.idf
        LEFT JOIN App:Niff n
        WITH f.idf = n.idf
        LEFT JOIN App:Statf s
        WITH f.idf = s.idf
        WHERE f.frsSup = 0
        ";
        return $this->getEntityManager()->createQuery($sql)->getResult();
    }
    

    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Frs
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
