<?php

namespace App\Repository;

use App\Entity\RechercheVoiture;
use App\Entity\Voiture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @extends ServiceEntityRepository<Voiture>
 *
 * @method Voiture|null find($id, $lockMode = null, $lockVersion = null)
 * @method Voiture|null findOneBy(array $criteria, array $orderBy = null)
 * @method Voiture[]    findAll()
 * @method Voiture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoitureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Voiture::class);
    }

/**
 * @return Query
 */
public function findAllVisibleQuery(RechercheVoiture $recherche): Query
{
    $query = $this->createQueryBuilder('voiture')
        ->andWhere('voiture.visible = :visible OR voiture.visible = 0')
        ->setParameter('visible', true);

    if ($recherche->getPrixMax()) {
        $query = $query
            ->andWhere('voiture.prix <= :prixMax')
            ->setParameter('prixMax', $recherche->getPrixMax());
    }

    if ($recherche->getAnneeMax()) {
        $query = $query
            ->andWhere('voiture.annee < :anneeMax')
            ->setParameter('anneeMax', $recherche->getAnneeMax());
    }
    if ($recherche->getKilometreMax()) {
        $query = $query
            ->andWhere('voiture.kilometre < :kilometreMax')
            ->setParameter('kilometreMax', $recherche->getKilometreMax());
    }

    return $query->getQuery();
}

/**
* @return Voiture[] Returns an array of Voiture objects
*/
    public function findLatest(): array
    {
        return $this->findVisibleQuery()
        ->setMaxResults(4)
        ->getQuery()
        ->getResult();
    }
}