<?php

namespace App\Repository;

use App\Entity\Planetas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Planetas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Planetas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Planetas[]    findAll()
 * @method Planetas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlanetasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Planetas::class);
    }

    // /**
    //  * @return Planetas[] Returns an array of Planetas objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Planetas
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
