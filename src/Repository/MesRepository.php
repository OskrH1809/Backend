<?php

namespace App\Repository;

use App\Entity\Mes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Mes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mes[]    findAll()
 * @method Mes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mes::class);
    }

    // /**
    //  * @return Mes[] Returns an array of Mes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Mes
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
