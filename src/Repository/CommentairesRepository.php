<?php

namespace App\Repository;

use App\Entity\Commentaires;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Commentaires>
 *
 * @method Commentaires|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commentaires|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commentaires[]    findAll()
 * @method Commentaires[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentairesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commentaires::class);
    }
    public function findAllVisibleQuery()
    {
        return $this->createQueryBuilder('c')
            ->where('c.activer = :activer')
            ->setParameter('activer', true)
            ->orderBy('c.created_at', 'DESC')
            ->getQuery();
    }
public function findLatestValidComments(): array
{
    return $this->createQueryBuilder('c')
        ->where('c.valide = :valide')
        ->setParameter('valide', true)
        ->orderBy('c.created_at', 'DESC')
        // ->setMaxResults($limit)
        ->getQuery()
        ->getResult();
}

//    /**
//     * @return Commentaires[] Returns an array of Commentaires objects
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

//    public function findOneBySomeField($value): ?Commentaires
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
