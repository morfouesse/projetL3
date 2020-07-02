<?php

namespace App\Controller;

use App\Entity\Ville;
use App\Entity\Equipement;
use App\Entity\LogementSearch;
use App\Entity\OffreReservation;
use App\Form\LogementSearchType;
use App\Entity\EquipementDunLogement;
use App\Manager\ListeOffreManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListeLogementController extends AbstractController
{
    /**
     * @Route("/listeLogement", name="listeLogement")
     */
    public function listelogement(Request $request,ListeOffreManager $lom)
    {

        $search = new LogementSearch();
        $form = $this->createForm(LogementSearchType::class,$search);
        $form->handleRequest($request);

        $actif=0;

        $lesOffresDeReservations = $this->getDoctrine()->getRepository(OffreReservation::class)->findHorraireLogement($search);

        $lesOffresDeReservationsAll = $this->getDoctrine()->getRepository(OffreReservation::class)->findAll();

        $lesOffresReservationsNonDepassés = $lom->dateOffreFini($lesOffresDeReservationsAll);

      

        foreach($lesOffresReservationsNonDepassés as $reservation)
        {

            // une recherche SQL qui donne aucun résultat
            if($search->getHeureDeDebutMin() != null || $search->getHeureDeFinMax() != null)
            { 
               
                // une recherche SQL avec une recherche (ex: la date du debut)
                if($search->getHeureDeDebutMin() == $reservation->getHeureOffreDebut() ||  $search->getHeureDeFinMax() == $reservation->getHeureOffreFin())
                {
                   
                  
                  
                        $actif = 2; break;
                       
                    
                } // une recherche SQL avec plusieurs recherche en meme temps(ex: la date de debut + la date de fin)
                // ne fonctionne pas
                if($search->getHeureDeDebutMin() == $reservation->getHeureOffreDebut() &&  $search->getHeureDeFinMax() == $reservation->getHeureOffreFin())
                {
                    $actif = 3; dump($reservation);break;
                 
                }
                else
                {
                
                    $actif = 1;
            
                }
               
            }
      
        }
        
     
       
       

        return $this->render('liste_logement/liste_logement.html.twig', [
            'lesOffresDeReservations' =>$lesOffresDeReservations,
            'lesOffresDeReservationsAll' => $lesOffresReservationsNonDepassés,
            'actif'=> $actif,
            'form'=> $form->createView()
        ]);
    }
}
