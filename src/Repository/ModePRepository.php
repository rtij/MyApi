<?php

namespace App\Repository;

use App\Entity\Modep;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Modep|null find($id, $lockMode = null, $lockVersion = null)
 * @method Modep|null findOneBy(array $criteria, array $orderBy = null)
 * @method Modep[]    findAll()
 * @method Modep[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModePRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Modep::class);
    }

    // /**
    //  * @return Modep[] Returns an array of Modep objects
    //  */

    
    public function FindNonSup(){
        $ModePQuery = $this->createQueryBuilder('f')
            ->select('f.codmp', 'f.desmp')
            ->andWhere('f.modepSup = 0')
            ->orderBy('f.desmp', 'ASC');
        $query = $ModePQuery->getQuery();
        return $query->execute();
    }
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Modep
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
