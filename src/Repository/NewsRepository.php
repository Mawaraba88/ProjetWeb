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
        $query = $this->_em->createQuery('SELECT n FROM App\Entity\News n JOIN n.categorynews c WHERE c.name = :criteria AND n.isActive=1
        ORDER BY n.createdAt DESC ');
        $query->setParameter('criteria', $criteria);
        //$query->setHint(\Doctrine\ORM\Query::HINT_INCLUDE_META_COLUMNS, true);
        $tab = $query->getResult();

        return $tab;
    }

    public function findwithNews($criteria)
    {
        $query = $this->_em->createQuery('SELECT n FROM App\Entity\News n JOIN n.categorynews c WHERE c.name = :criteria AND n.isActive=1
        ORDER BY n.createdAt DESC ');
        $query->setParameter('criteria', $criteria);
        $query->setMaxResults(3);
        //$query->setHint(\Doctrine\ORM\Query::HINT_INCLUDE_META_COLUMNS, true);
        $tab = $query->getResult();

        return $tab;
    }

    public function findwithEventsAndSeminars($criteria)
    {
        $query = $this->_em->createQuery('SELECT n FROM App\Entity\News n JOIN n.categorynews c WHERE c.name = :criteria AND n.isActive=1
        ORDER BY n.createdAt DESC ');
        $query->setParameter('criteria', $criteria);
        $query->setMaxResults(1);
        //$query->setHint(\Doctrine\ORM\Query::HINT_INCLUDE_META_COLUMNS, true);
        $tab = $query->getResult();

        return $tab;
    }

    public function findwithSearchNews(SearchNews $search, $criteria) {
        $searchString = empty($search->string) ? '' : $search->string;
       // die(var_dump(($search)));
        $startCreatedAt = empty($search->startCreatedAt) ? '' : $search->startCreatedAt->format('Y-m-d');
        $searchEndDate = empty($search->endCreatedAt) ? '' : $search->endCreatedAt->format('Y-m-d');

        //die(var_dump($search->string));
        $okQuery = false;

        $tab = array();

        if(!empty($searchString) && !empty($startCreatedAt) && !empty($searchEndDate)) {
            $okQuery = true;
            $query = $this->_em->createQuery('SELECT n FROM App\Entity\News n 
            JOIN n.categorynews c  WHERE c.name = :criteria AND n.isActive=1 AND 
            (n.title LIKE :searchString OR  n.startCreatedAt >= :startCreatedAt AND n.endCreatedAt <= :searchEndDate)');
            //die(var_dump($query));
            $query->setParameter('searchString', '%' . $searchString . '%');
            $query->setParameter('startCreatedAt', $startCreatedAt);
            $query->setParameter('searchEndDate', $searchEndDate);
        } elseif(!empty($searchString)) {
            //die(var_dump($search));
            $okQuery = true;
            $query = $this->_em->createQuery('SELECT n FROM App\Entity\News n 
            JOIN n.categorynews c  WHERE c.name = :criteria AND n.isActive=1 AND 
            n.title LIKE :searchString ORDER BY n.createdAt DESC');
            $query->setParameter('searchString', '%' . $searchString . '%');
        } elseif(!empty($startCreatedAt) && !empty($searchEndDate)) {
            $okQuery = true;
            $query = $this->_em->createQuery('SELECT n FROM App\Entity\News n 
            JOIN n.categorynews c  WHERE c.name = :criteria AND n.isActive=1 AND 
            (n.startCreatedAt >= :startCreatedAt AND n.endCreatedAt <= :searchEndDate)
            ORDER BY n.createdAt DESC');
            $query->setParameter('startCreatedAt', $startCreatedAt);
            $query->setParameter('searchEndDate', $searchEndDate);
        }

        if($okQuery) {
            $query->setParameter('criteria', $criteria);
            //$query->setHint(\Doctrine\ORM\Query::HINT_INCLUDE_META_COLUMNS, true);
            $tab = $query->getResult();
        }

        return $tab;
    }


  /*  public function findwithSearchNews(SearchNews $search, $criteria) {
        $searchString = empty($search->string) ? '' : $search->string;
        // die(var_dump(($search)));


        //die(var_dump($search->string));
        $okQuery = false;

        $tab = array();

        if(!empty($searchString) ) {
            $okQuery = true;
            $query = $this->_em->createQuery('SELECT n FROM App\Entity\News n 
            JOIN n.categorynews c  WHERE c.name = :criteria AND n.isActive=1 AND 
            (n.title LIKE :searchString) ORDER BY n.createdAt DESC');
            $query->setParameter('searchString', '%' . $searchString . '%');
            //die(var_dump($query));

        }

        if($okQuery) {
            $query->setParameter('criteria', $criteria);
            //$query->setHint(\Doctrine\ORM\Query::HINT_INCLUDE_META_COLUMNS, true);
            $tab = $query->getResult();
        }

        return $tab;
    }
  */

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
