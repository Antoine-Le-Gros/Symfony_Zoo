<?php

namespace App\Repository;

use App\Entity\Espece;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Espece>
 *
 * @method Espece|null find($id, $lockMode = null, $lockVersion = null)
 * @method Espece|null findOneBy(array $criteria, array $orderBy = null)
 * @method Espece[]    findAll()
 * @method Espece[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EspeceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Espece::class);
    }

    public function getAllAnimals(int $idEspece, string $search): array
    {
        $qb = $this->createQueryBuilder('e');
        $qb->leftJoin('e.animals', 'animals')
            ->leftjoin('animals.image', 'image')
            ->addSelect('image')
            ->addSelect('animals')
            ->where('e.id = :id')
            ->andWhere('animals.nomAnimal LIKE :search')
            ->setParameter('id', $idEspece)
            ->setParameter('search', '%'.$search.'%');

        return $qb->getQuery()->execute();
    }

    /**
     * @return Espece[]
     */
    public function getAllSpeciesWithPicture(string $search): array
    {
        $qb = $this->createQueryBuilder('e');
        $qb->leftJoin('e.image', 'image')
            ->addSelect('image')
            ->Where('e.libEspece LIKE :search')
            ->setParameter('search', '%'.$search.'%')
            ->orderBy('e.libEspece');

        return $qb->getQuery()->execute();
    }

    //    /**
    //     * @return Espece[] Returns an array of Espece objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Espece
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
