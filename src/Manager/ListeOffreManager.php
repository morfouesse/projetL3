<?php

namespace App\Manager;

use Doctrine\Common\Collections\ArrayCollection;





class ListeOffreManager
{
    public function dateOffreFini($lesOffresDeReservationsAll):Array
    {
         //date en string
         $dateActuelleSTR=date("Y/m/d");
         $dateActuelle = date_create($dateActuelleSTR);
       
        foreach($lesOffresDeReservationsAll as $reservation)
        {
          
            //uneDateDeReservation en date
            $uneDateDeReservationSTR = $reservation->getDateOffre(); 
            $uneDateDeReservation = date_create($uneDateDeReservationSTR);
            if($dateActuelle < $uneDateDeReservation)
            {
                $lesOffresReservationsNonDepassés[] = $reservation;
            }
        }
        return $lesOffresReservationsNonDepassés;
    }


}