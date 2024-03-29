<?php

namespace App\Repository;

use App\Entity\PetOwner;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PetOwner>
 *
 * @method PetOwner|null find($id, $lockMode = null, $lockVersion = null)
 * @method PetOwner|null findOneBy(array $criteria, array $orderBy = null)
 * @method PetOwner[]    findAll()
 * @method PetOwner[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PetOwnerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PetOwner::class);
    }

    //    /**
    //     * @return PetOwner[] Returns an array of PetOwner objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?PetOwner
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
