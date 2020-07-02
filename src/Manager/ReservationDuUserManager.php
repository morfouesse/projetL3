<?php

namespace App\Manager;

use App\Entity\User;
use App\Entity\Commentaire;
use Doctrine\Common\Collections\ArrayCollection;





class ReservationDuUserManager
{
    public function addReservationDuUser($offreReservation,$User,$om){

        $offreReservation->setReserverOffre(1);
        $offreReservation->setUnereservationDunUser($User);

        $om->flush();
        return $offreReservation;  
    }

    public function delReservationDuUser($offreReservation,$User,$om){
       

        $offreReservation->setReserverOffre(0);
        $offreReservation->setUnereservationDunUser(null);
        $om->flush();
        return $offreReservation;  
    }

    public function annulerReservationDate($lesOffreReserverDuUser,$manager,$om):Array{
        //Vous pouvez annulez une réservation au plus tard un jour avant la date actuelle

         //date en string
         $dateActuelleSTR=date("Y/m/d");
          // dateActuelle
        $dateActuelle = date_create($dateActuelleSTR);

      
        foreach($lesOffreReserverDuUser as $offreReservation)
        {
            $uneDateDeReservationSTR = $offreReservation->getDateOffre(); 
            //uneDateDeReservation en date
            $uneDateDeReservation = date_create($uneDateDeReservationSTR);

            if($dateActuelle < $uneDateDeReservation)
            { //  on peu annuler la réservation si la date actuelle est plus petite que la date de réservation
                
                $offreReservation->setDateActif(1);
                $manager->persist($offreReservation);
                $om->flush();
               
            }
            else{ //on peu pas annuler
                $offreReservation->setDateActif(0);
                $manager->persist($offreReservation);
                $om->flush();
            }
        }
      
        return $lesOffreReserverDuUser;
    }
    

    public function verifDatePasser($lesOffresReserverDuUser,$manager,$om){ 
        // on peu commenté seulement si la date actuel est passé de un jour par rapport a la réservation

     
         //date en string
        $dateActuelleSTR=date("Y/m/d");
        // dateActuelle
        $dateActuelle = date_create($dateActuelleSTR);
          
         
        foreach($lesOffresReserverDuUser as $uneOffre)
        {
            // date de reservation en string
            $uneDateDeReservationSTR = $uneOffre->getDateOffre(); 
            //uneDateDeReservation en date
            $uneDateDeReservation = date_create($uneDateDeReservationSTR);
        

            if($dateActuelle >= $uneDateDeReservation)// si la date actuelle est plus grande ou égale que la date de reservation alors on peu commenté le logement
            { 
                // plus tot que la date actuelle

                if($uneOffre->getUnCommentaireDuneOffre() == null)
                {
                    $unCommentaire = new Commentaire();
                    $unCommentaire->setActif(1); // le commentaire existe
                    $uneOffre->setUnCommentaireDuneOffre($unCommentaire);
                    $manager->persist($unCommentaire);
                    $om->flush();
                }
    
                $uneOffre->getUnCommentaireDuneOffre()->setActif(1);
                $manager->persist($uneOffre->getUnCommentaireDuneOffre());
                $om->flush();

            }
            else
            {   // plus tard que la date actuelle
                if($uneOffre->getUnCommentaireDuneOffre() == null)
                {
                    $unCommentaire = new Commentaire();
                    $unCommentaire->setActif(0);
                    $uneOffre->setUnCommentaireDuneOffre($unCommentaire);
                    $manager->persist($unCommentaire);
                    $om->flush();
                }
            }
        }

    }

   
}