<?php

namespace App\Repository;

use App\Entity\EquipementDunLogement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EquipementDunLogement|null find($id, $lockMode = null, $lockVersion = null)
 * @method EquipementDunLogement|null findOneBy(array $criteria, array $orderBy = null)
 * @method EquipementDunLogement[]    findAll()
 * @method EquipementDunLogement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EquipementDunLogementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EquipementDunLogement::class);
    }

    // /**
    //  * @return EquipementDunLogement[] Returns an array of EquipementDunLogement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EquipementDunLogement
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
