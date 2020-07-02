<?php

namespace App\Repository;


use App\Entity\LogementSearch;
use App\Entity\OffreReservation;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method OffreReservation|null find($id, $lockMode = null, $lockVersion = null)
 * @method OffreReservation|null findOneBy(array $criteria, array $orderBy = null)
 * @method OffreReservation[]    findAll()
 * @method OffreReservation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OffreReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OffreReservation::class);
    }

     /**
      * @return OffreReservation[] 
      */
    
    public function findHorraireLogement(LogementSearch $search)
    {
        if($search->getHeureDeDebutMin())
        {
       $qb= $this->createQueryBuilder('o')
      
           ->andWhere('o.heureOffreDebut = :heureDeDebutMin')
           ->setParameter('heureDeDebutMin', $search->getHeureDeDebutMin())
           ->innerJoin('o.uneReservationDunLogement','l')
           ->addSelect('l')
           ->innerJoin('l.laVilleDunLogement','v')
           ->addSelect('v')
           ->select('l.nomLogement,l.nomTypeLogement,l.descriptionLogement,v.nomVille,l.prixLogement,o.dateOffre,o.heureOffreDebut,o.heureOffreFin,o.id')
           ->getQuery();
           return $qb->execute()
       ;
        }

        if($search->getHeureDeFinMax())
        {
       $qb= $this->createQueryBuilder('o')
      
           ->andWhere('o.heureOffreFin = :heureDeFinMax')
           ->setParameter('heureDeFinMax', $search->getHeureDeFinMax())
           ->innerJoin('o.uneReservationDunLogement','l')
           ->addSelect('l')
           ->innerJoin('l.laVilleDunLogement','v')
           ->addSelect('v')
           ->select('l.nomLogement,l.nomTypeLogement,l.descriptionLogement,v.nomVille,o.dateOffre,o.heureOffreDebut,o.heureOffreFin,l.prixLogement,o.id')
           ->getQuery();
           return $qb->execute()
       ;
        }

    }
   
    
    /**
    * @return OffreReservation[] 
    */
    
    public function  findLesLogementsLesPlusReserver()
    { //Les logements les plus réservés par nos utilisateurs
        $qb= $this->createQueryBuilder('o')
      
        ->innerJoin('o.uneReservationDunLogement','l')
        ->addSelect('l')
        ->innerJoin('l.laVilleDunLogement','v')
        ->addSelect('v')
        ->innerJoin('o.uneReservationDunUser','u')
        ->addSelect('v')
        ->groupBy('l.nomLogement')
        ->select('l.nomLogement,l.nomTypeLogement,v.nomVille,COUNT(u.id)')
        ->orderBy('COUNT(u.id)', 'DESC')
        ->getQuery();
        return $qb->execute()
    ;

    }

    /*
    public function findOneBySomeField($value): ?OffreReservation
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
