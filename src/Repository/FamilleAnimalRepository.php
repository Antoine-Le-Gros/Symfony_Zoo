<?php

namespace App\Repository;

use App\Entity\FamilleAnimal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FamilleAnimal>
 *
 * @method FamilleAnimal|null find($id, $lockMode = null, $lockVersion = null)
 * @method FamilleAnimal|null findOneBy(array $criteria, array $orderBy = null)
 * @method FamilleAnimal[]    findAll()
 * @method FamilleAnimal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FamilleAnimalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FamilleAnimal::class);
    }

    public function getAllSpecies(int $idFamily): FamilleAnimal
    {
        $qb = $this->createQueryBuilder('f');
        $qb->leftJoin('f.especes', 'especes')
            ->leftJoin('especes.image', 'images')
            ->addSelect('images')
            ->addSelect('especes')
            ->where('f.id = :id')
            ->setParameter('id', $idFamily);

        return $qb->getQuery()->execute()[0];
    }

    /**
     * @return FamilleAnimal[]
     */
    public function getAllFamiliesWithPicture(): array
    {
        $qb = $this->createQueryBuilder('f');
        $qb->leftJoin('f.image', 'image')
            ->addSelect('image')
            ->orderBy('f.nomAnimal');

        return $qb->getQuery()->execute();
    }

    //    /**
    //     * @return FamilleAnimal[] Returns an array of FamilleAnimal objects
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

    //    public function findOneBySomeField($value): ?FamilleAnimal
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
