<?php

namespace App\Repository;


use App\Classe\SearchNews;
use App\Entity\News;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method News|null find($id, $lockMode = null, $lockVersion = null)
 * @method News|null findOneBy(array $criteria, array $orderBy = null)
 * @method News[]    findAll()
 * @method News[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, News::class);
    }

    public function findNewsByCriteria($criteria)
    {
        $query = $this->_em->createQuery('SELECT n FROM App\Entity\News n JOIN n.categorynews c WHERE c.name = :criteria');
        $query->setParameter('criteria', $criteria);
        //$query->setHint(\Doctrine\ORM\Query::HINT_INCLUDE_META_COLUMNS, true);
        $tab = $query->getResult();

        return $tab;
    }


    /**
     * requite qui permet de recupérer les articles en fonctions de la recherche de l'utilisateur
     * @return News[]
     */
    public function findwithSearchNews(SearchNews $search)
    {
        $query = $this
            ->createQueryBuilder('n')
            ->select('c', 'n')
            ->join('n.categoriesnews', 'c');

        if(!empty($search->categoriesnews)){
            $query = $query
                ->andWhere('c.id IN(:categoriesNews)')
                ->setParameter('categoriesNews', $search->categoriesNews);
        }
        if(!empty($search->startCreatedAt))
        {
            $query = $query
            ->andWhere('n.startCreatedAt >='.date('Y-m-d'));
        }
        if(!empty($search->endCreatedAt))
        {
            $query = $query
                ->andWhere('n.endCreatedAt >='.date('Y-m-d'));
        }
        return $query->getQuery()->getResult();

    }

    // /**
    //  * @return News[] Returns an array of News objects
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
    public function findOneBySomeField($value): ?News
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
