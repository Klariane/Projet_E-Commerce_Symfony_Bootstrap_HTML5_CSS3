<?php

namespace App\Repository;

use App\Classe\Search;
use App\Entity\Product;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }


    /**
     * requete permettant de récuperer les produits en fonction de la recherche de l'utilisateur
     * @return Product[]
     */

    public function findWithSearch(Search $search)
    {
        $query = $this 
                ->createQueryBuilder('p')
                ->select('c', 'p')
                ->join('p.category', 'c');

        if(!empty($search->categories))
        {
            $query = $query
                ->andWhere('c.id IN (:categories)')
                ->setParameter('categories', $search->categories);
        }

        if(!empty($search->string))
        {
            $query = $query
                ->andWhere('p.name LIKE :string')
                ->setParameter('string', "%{$search->string}%");
        }

        return $query->getQuery()->getResult();
    }

    // /**
    //  * @return Product[] Returns an array of Product objects
    //  */
    
    // public function getProductByName($productName)
    // {
    //     return $this->createQueryBuilder('a') // le 'a' est un alias
    //                 ->andWhere('a.name Like :val') //:val est un parametre
    //                 ->setParameter('val', '%'.$productName . '%') // permet de lier le parametre val a ma variable $articleName
    //                 ->orderBy('a.name', 'ASC')//ordonner par le nom des articles dans l'ordre alphabetique
    //                 ->getQuery()
    //                 ->getResult();
    //                 //ces deux dernieres lignes permettent de recuperer le resultat de la requete(ici, un tableau d'articles)

    // }
    
    // public function getProductOrderByPrice()
    // {
    //     return $this->createQueryBuilder('a')
    //         	    ->orderBy('a.createdAt', 'DESC')
    //                 ->getQuery()
    //                 ->getResult();
    // }
    
    
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
    public function findOneBySomeField($value): ?Product
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
