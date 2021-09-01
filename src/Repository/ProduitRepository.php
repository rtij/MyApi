<?php

namespace App\Repository;

use App\Entity\Produit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Produit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produit[]    findAll()
 * @method Produit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produit::class);
    }
    public function FindPro(){
        $FamQuery = $this->createQueryBuilder('p')
            ->andWhere('p.prodSup = 0')
            ->orderBy('p.idprod', 'ASC');
        $query = $FamQuery->getQuery();
        return $query->execute();
    }
    public function FindNonSup()
    {
        $sql = "SELECT p.idprod,p.desproduit,p.refproduit,p.prixap,p.prixvp,p.seuilap,p.prodSup,u.idu,f.idfamille 
        FROM App:Produit p
        JOIN App:Famille f
        WITH f.idfamille = p.idfamille
        JOIN App:Unite u
        WITH u.idu = p.idu        
        WHERE p.prodSup = 0
        ";
        return $this->getEntityManager()->createQuery($sql)->getResult();
    }
    // /**
    //  * @return Produit[] Returns an array of Produit objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Produit
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
