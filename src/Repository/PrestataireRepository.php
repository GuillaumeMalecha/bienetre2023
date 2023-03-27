<?php

namespace App\Repository;

use App\Entity\Prestataire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Prestataire>
 *
 * @method Prestataire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Prestataire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Prestataire[]    findAll()
 * @method Prestataire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrestataireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Prestataire::class);
    }

    public function add(Prestataire $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Prestataire $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    public function find4last()
    {
        return $this->createQueryBuilder('p')
            ->leftJoin('p.nom','b','p.nom = b.id')
            ->setMaxResults(4)
            ->orderBy('b.id', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return Prestataire[] Returns an array of Prestataire objects
     */
    public function findByRecherche($nom = null, $categorie = null, $commune = null): array
    {
        $query = $this->createQueryBuilder('p');
            if ($nom != null) {
                $query
                ->andWhere('p.nom LIKE :nom')
                ->setParameter('nom', '%'.$nom.'%');
            }
            if ($categorie != null) {
                $query->leftJoin('p.proposer', 'c')
                ->andWhere('c.id = :categorie')
                ->setParameter('categorie', $categorie);
            }
            if ($commune != null) {
                $query->leftJoin('p.profil', 'u')
                    ->leftJoin('u.commune', 'co')
                    ->leftJoin('co.localite', 'l')
                    ->leftJoin('co.codePostal', 'cp')
                    ->andWhere(
                        $query->expr()->orX(
                            'co.commune LIKE :commune',
                            'l.nom LIKE :commune',
                            'cp.codePostal = :commune'
                        )
                    )
                    ->setParameter('commune', '%' . $commune . '%');
            }

        return $query
            ->getQuery()
            ->getResult()
        ;
    }

//    public function findOneBySomeField($value): ?Prestataire
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
