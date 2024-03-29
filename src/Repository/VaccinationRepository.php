<?php

namespace App\Repository;

use App\Entity\Vaccination;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Vaccination>
 *
 * @method Vaccination|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vaccination|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vaccination[]    findAll()
 * @method Vaccination[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VaccinationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vaccination::class);
    }

    //    /**
    //     * @return Vaccination[] Returns an array of Vaccination objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('v')
    //            ->andWhere('v.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('v.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Vaccination
    //    {
    //        return $this->createQueryBuilder('v')
    //            ->andWhere('v.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
