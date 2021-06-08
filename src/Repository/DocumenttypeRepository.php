<?php

namespace App\Repository;

use App\Entity\Documenttype;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Documenttype|null find($id, $lockMode = null, $lockVersion = null)
 * @method Documenttype|null findOneBy(array $criteria, array $orderBy = null)
 * @method Documenttype[]    findAll()
 * @method Documenttype[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocumenttypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Documenttype::class);
    }

    // /**
    //  * @return Documenttype[] Returns an array of Documenttype objects
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
    public function findOneBySomeField($value): ?Documenttype
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
