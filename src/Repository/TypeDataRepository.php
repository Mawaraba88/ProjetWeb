<?php

namespace App\Repository;

use App\Entity\TypeData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeData|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeData|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeData[]    findAll()
 * @method TypeData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeDataRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeData::class);
    }

    // /**
    //  * @return TypeData[] Returns an array of TypeData objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeData
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
