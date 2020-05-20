<?php

namespace App\Repository;

use App\Entity\Property;
use App\Entity\PropertySearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Property[]  findAllVisible sold=false
 * @method Property[]  findLatest sold=false maxResults (4)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Property::class);
    }

    private function findVisibleQuery():QueryBuilder
    {
        return $this->createQueryBuilder('p')
           ->where('p.sold =false');
    }
    /**
     *@return Query
     */
    public function findAllVisibleQuery(PropertySearch $search): Query
    {

        $query= $this->findVisibleQuery();
        
        if($search->getMaxPrice()){
            $query=$query
                ->andwhere('p.price<= :maxprice')
                ->setParameter('maxprice',$search->getMaxPrice());/*NOTES
            setParameter en amont permet d'être sur qu'on ne touche pas la bdd directement*/
        }
        if($search->getMinSurface()){
            $query=$query
                ->setParameter('minsurface',$search->getMinSurface())
                ->andwhere('p.surface>= :minsurface');/*ASK
            l'ordre a t'il une importance*/
            
        }
        
        return $query->getQuery();/*NOTES
        avoir créé $query plutot que de faire un return tout de suite 
        permetde rajouter des conditions */
           
        

    }
    /**
     * @return Property[]
     */
    public function findLatest(): array
    {
        
        return $this->findVisibleQuery()
           ->setMaxResults(4)
           ->orderBy('p.id','DESC')
           ->getQuery()
           ->getResult();
        
    }

    // /**
    //  * @return Property[] Returns an array of Property objects
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
    public function findOneBySomeField($value): ?Property
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
