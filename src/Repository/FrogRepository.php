<?php

namespace App\Repository;

use App\Entity\Frog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Frog>
 *
 * @method Frog|null find($id, $lockMode = null, $lockVersion = null)
 * @method Frog|null findOneBy(array $criteria, array $orderBy = null)
 * @method Frog[]    findAll()
 * @method Frog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FrogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Frog::class);
    }

    public function save(Frog $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Frog $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findSearch(Frog $entity) {
        $query = $this
        ->createQueryBuilder('f');

        if (!empty($entity->specie)) {
            $query = $query
                ->andWhere('f.specie = :specie')
                ->setParameter('specie', $entity->specie);
        }

        if (!empty($entity->size)) {
            $query = $query
                ->andWhere('f.size = :size')
                ->setParameter('size', $entity->size);
        }

        if (!empty($entity->skinColor)) {
            $query = $query
                ->andWhere('f.skinColor = :skinColor')
                ->setParameter('skinColor', $entity->skinColor);
        }

        return $query;
    }

//    /**
//     * @return Frog[] Returns an array of Frog objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Frog
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
