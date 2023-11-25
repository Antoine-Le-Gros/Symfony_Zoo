<?php

namespace App\Repository;

use App\Entity\CategorieAnimal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CategorieAnimal>
 *
 * @method CategorieAnimal|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieAnimal|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieAnimal[]    findAll()
 * @method CategorieAnimal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieAnimalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategorieAnimal::class);
    }

    /**
     * Listage des catégories avec leurs familles.
     *
     * @return CategorieAnimal[]
     */
    public function getAllCategories(): array
    {
        $qb = $this->createQueryBuilder('c');
        $qb->leftJoin('c.familleAnimals', 'familles')
            ->addSelect('familles')
            ->groupBy('c.id');

        return $qb->getQuery()->execute();
    }

    //    /**
    //     * @return CategorieAnimal[] Returns an array of CategorieAnimal objects
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

    //    public function findOneBySomeField($value): ?CategorieAnimal
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
