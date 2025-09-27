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

    public function findFilteredCovoits(
        $depart,
        $arrivee,
        $date,
    ): array {
        $query = $this->createQueryBuilder('c');
        return $query->select('c.id, c.lieu_depart, c.lieu_arrivee, c.date_arrivee')
            ->andWhere('c.lieu_depart = :lieu_depart')
            ->andWhere('c.lieu_arrivee = :lieu_arrivee')
            ->andWhere('c.date_arrivee = :date_arrivee')
            ->setParameter('lieu_depart', $depart)
            ->setParameter('lieu_arrivee', $arrivee)
            ->setParameter('date_arrivee', $date)
            ->getQuery()
            ->getResult();
    }

}
