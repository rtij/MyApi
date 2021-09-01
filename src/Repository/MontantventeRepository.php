<?php

namespace App\Repository;

use App\Entity\Montantvente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Montantvente|null find($id, $lockMode = null, $lockVersion = null)
 * @method Montantvente|null findOneBy(array $criteria, array $orderBy = null)
 * @method Montantvente[]    findAll()
 * @method Montantvente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MontantventeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Montantvente::class);
    }

    // /**
    //  * @return Montantvente[] Returns an array of Montantvente objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Montantvente
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
