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
        $query = $this->_em->createQuery('SELECT d FROM App\Entity\Documenttype d JOIN d.categorydonnees c WHERE c.name = :criteria');
        $query->setParameter('criteria', $criteria);
        //$query->setHint(\Doctrine\ORM\Query::HINT_INCLUDE_META_COLUMNS, true);
        $tab = $query->getResult();

        return $tab;
    }

    /**
     * requite qui permet de recupérer les articles en fonctions de la recherche de l'utilisateur
     * @return Documenttype[]
     */
    public function findwithSearch(Search $search)
    {
        //creation d'une requete
        $query = $this
            ->createQueryBuilder('d')
            ->select('c', 'd', 'a')
            ->join('d.categorydonnees', 'c')
            ->join('d.author', 'a');


        if(!empty($search->categoriesDonnees)){
            $query = $query
                ->andWhere('c.id IN(:categoriesDonnees)')
                ->setParameter('categoriesDonnees', $search->categoriesDonnees);
        }


       if(!empty(($search->string )or( $search->authors))){
            $query = $query
                ->andWhere('d.title Like :string' )
                ->orWhere('a.id  Like :authors')
              //  ->andWhere('d.author Like :string')
                ->setParameter('string', "%{$search->string}%")
                ->setParameter('authors', "%{$search->authors}%");
        }

        /*if(!empty($search->author)){
            $query = $query
                ->andWhere('d.author Like :authors' )
                ->setParameter('authors', "%{$search->authors}%");
        }*/

        return $query->getQuery()->getResult();
    }
}
