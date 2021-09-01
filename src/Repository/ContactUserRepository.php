<?php

namespace App\Repository;

use App\Entity\Customer\Contactuser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Contactuser|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contactuser|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contactuser[]    findAll()
 * @method Contactuser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contactuser::class);
    }

    public function findContactByUsergroup($value)
    {
        $sql = "SELECT c.idcontact,c.tel,g.idgroup,u.emailu,u.username 
        FROM Customer:Contactuser c
        JOIN Customer:Groupe g
        WITH g.idgroup = u.idgroup
        JOIN  Customer:Users u
        WITH c.iduser = u.iduser
        WHERE g.idgroup = :val
        ";
        
        return $this->getEntityManager('customer')->createQuery($sql)->setParameter('val', $value)
        ->getResult();
        
    }
    // /**
    //  * @return Contactuser[] Returns an array of Contactuser objects
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
    public function findOneBySomeField($value): ?Contactuser
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
