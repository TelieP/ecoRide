<?php

namespace App\Repository;

use App\Entity\Covoiturage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Covoiturage>
 */
class CovoiturageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Covoiturage::class);
    }

 public function findBySearchCriteria(array $criteria): array
{
    $queryBuilder = $this->createQueryBuilder('c');

    if (!empty($criteria['lieu_depart'])) {
        $lieuDepart = trim($criteria['lieu_depart']);
        $queryBuilder->andWhere('LOWER(c.lieu_depart) LIKE :depart')
                     ->setParameter('depart', '%' . strtolower($lieuDepart) . '%');
    }

    if (!empty($criteria['lieu_arrivee'])) {
        $lieuArrivee = trim($criteria['lieu_arrivee']);
        $queryBuilder->andWhere('LOWER(c.lieu_arrivee) LIKE :arrivee')
                     ->setParameter('arrivee', '%' . strtolower($lieuArrivee) . '%');
    }

   
    if (!empty($criteria['date_depart'])) {
       
        $queryBuilder->andWhere('DATE(c.dateDepart) = :date');
                     $queryBuilder->setParameter('date', $criteria['date_depart']->format('Y-m-d'));
    }

    return $queryBuilder->orderBy('c.date_depart', 'ASC')
                        ->getQuery()
                        ->getResult();
}
    // public function findBySearchCriteria(array $criteria): array
    // {
    //     $queryBuilder = $this->createQueryBuilder('c');

    //     if (!empty($criteria['lieu_depart'])) {
    //         $queryBuilder->andWhere('c.lieu_depart LIKE :depart')
    //                      ->setParameter('depart', '%' . $criteria['lieu_depart'] . '%');
    //     }

    //     if (!empty($criteria['lieu_arrivee'])) {
    //         $queryBuilder->andWhere('c.lieu_arrivee LIKE :arrivee')
    //                      ->setParameter('arrivee', '%' . $criteria['lieu_arrivee'] . '%');
    //     }

    //     if (!empty($criteria['date_depart'])) {
    //         // $dateDepart = new \DateTime($criteria['date_depart']);
    //         $queryBuilder->andWhere('c.date_depart = :date')
    //                      ->setParameter('date', $criteria['date_depart']);
    //                     //  ->setParameter('date', $criteria['date_depart']->format('Y-m-d'));
    //     }

    //     return $queryBuilder->orderBy('c.date_depart', 'ASC')
    //                         ->getQuery()
    //                         ->getResult();
    // }

    //    /**
    //     * @return Covoiturage[] Returns an array of Covoiturage objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Covoiturage
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
