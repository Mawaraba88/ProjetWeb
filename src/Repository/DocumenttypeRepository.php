<?php

namespace App\Repository;

use App\Classe\Search;
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

    public function findDocumentsByCriteria($criteria)
    {
        $query = $this->_em->createQuery('SELECT d FROM App\Entity\Documenttype d 
        JOIN d.categorydonnees c WHERE c.name = :criteria AND d.isActive=1
        ORDER BY d.createdAt DESC');
        $query->setParameter('criteria', $criteria);
        //$query->setHint(\Doctrine\ORM\Query::HINT_INCLUDE_META_COLUMNS, true);
        $tab = $query->getResult();

        return $tab;
    }

    public function findwithDocuments($criteria)
    {
        $query = $this->_em->createQuery('SELECT d FROM App\Entity\Documenttype d 
        JOIN d.categorydonnees c WHERE c.name = :criteria AND d.isActive=1
        ORDER BY d.createdAt DESC');
        $query->setParameter('criteria', $criteria);
        $query->setMaxResults(3);
        //$query->setHint(\Doctrine\ORM\Query::HINT_INCLUDE_META_COLUMNS, true);
        $tab = $query->getResult();
        return $tab;
    }

    public function findwithSearch(Search $search, $criteria) {
        $searchString = empty($search->string) ? '' : $search->string;
        //die(var_dump(($search)));
        $searchDate = empty($search->searchDate) ? '' : $search->searchDate->format('Y-m-d');
        //die(var_dump($search->string));
        $okQuery = false;

        $tab = array();

        if(!empty($searchString) && !empty($searchDate)) {
            $okQuery = true;
            $query = $this->_em->createQuery('SELECT d FROM App\Entity\Documenttype d 
            JOIN d.categorydonnees c JOIN d.author a WHERE c.name = :criteria AND d.isActive=1 AND 
            (d.title LIKE :searchString OR a.firstname LIKE :searchString OR a.lastname LIKE :searchString 
            OR d.createdAt like :searchDate)
            ORDER BY d.createdAt DESC');
            $query->setParameter('searchString', '%' . $searchString . '%');
            $query->setParameter('searchDate', '%' . $searchDate . '%');
        } elseif(!empty($searchString)) {
            //die(var_dump($search));
            $okQuery = true;
            $query = $this->_em->createQuery('SELECT d FROM App\Entity\Documenttype d 
            JOIN d.categorydonnees c JOIN d.author a WHERE c.name = :criteria AND d.isActive=1 AND 
            (d.title LIKE :searchString OR a.firstname LIKE :searchString OR a.lastname LIKE :searchString)
            ORDER BY d.createdAt DESC');
            $query->setParameter('searchString', '%' . $searchString . '%');
        } elseif(!empty($searchDate)) {
            $okQuery = true;
            $query = $this->_em->createQuery('SELECT d FROM App\Entity\Documenttype d 
            JOIN d.categorydonnees c JOIN d.author a WHERE c.name = :criteria AND d.isActive=1 AND 
            d.createdAt like :searchDate
            ORDER BY d.createdAt DESC');
            $query->setParameter('searchDate', '%' . $searchDate . '%');
        }

        if($okQuery) {
            $query->setParameter('criteria', $criteria);
            //$query->setHint(\Doctrine\ORM\Query::HINT_INCLUDE_META_COLUMNS, true);
            $tab = $query->getResult();
        }

        return $tab;
    }


}
