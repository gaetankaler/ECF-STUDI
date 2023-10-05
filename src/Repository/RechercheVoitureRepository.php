<?php

namespace App\Repository;

use App\Entity\RechercheVoiture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RechercheVoiture>
 *
 * @method RechercheVoiture|null find($id, $lockMode = null, $lockVersion = null)
 * @method RechercheVoiture|null findOneBy(array $criteria, array $orderBy = null)
 * @method RechercheVoiture[]    findAll()
 * @method RechercheVoiture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RechercheVoitureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RechercheVoiture::class);
    }
//    /**
//     * @return RechercheVoiture[] Returns an array of RechercheVoiture objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?RechercheVoiture
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
