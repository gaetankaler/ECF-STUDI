<?php

namespace App\Repository;

use App\Entity\HoraireGarage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<HoraireGarage>
 *
 * @method HoraireGarage|null find($id, $lockMode = null, $lockVersion = null)
 * @method HoraireGarage|null findOneBy(array $criteria, array $orderBy = null)
 * @method HoraireGarage[]    findAll()
 * @method HoraireGarage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HoraireGarageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HoraireGarage::class);
    }

//    /**
//     * @return HoraireGarage[] Returns an array of HoraireGarage objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('h.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?HoraireGarage
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
