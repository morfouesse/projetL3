<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Photo;
use App\Entity\Logement;
use App\Entity\Commentaire;
use App\Entity\OffreReservation;
use App\Entity\EquipementDunLogement;
use Doctrine\ORM\EntityManagerInterface;
use App\Manager\ReservationDuUserManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InfoLogementController extends AbstractController
{
    /**
     * @Route("/infoLogement/{idLogement}/{idOffre}", name="infoLogement")
     */
    public function infoLogement($idOffre,$idLogement)
    {

        // deaseble l'extension php debug si cest le premier findByName que tu fais
        $lesPhotosDunLogement=$this->getDoctrine()->getRepository(Photo::class)->findByUnePhotoDunLogement($idLogement);
        $lesInfosDunLogement=$this->getDoctrine()->getRepository(OffreReservation::class)->findById($idOffre);
        
        $lesEquipementsDunLogement=$this->getDoctrine()->getRepository(EquipementDunLogement::class)->findByLeLogement($idLogement);
      
   
        $lesCommentairesDunLogement=$this->getDoctrine()->getRepository(Commentaire::class)->findByLeCommentaireDuLogement($idLogement);

        return $this->render('info_logement/info_logement.html.twig', [
            'lesInfosDunLogement' => $lesInfosDunLogement,
            'lesPhotosDunLogement' => $lesPhotosDunLogement,
            'lesEquipementsDunLogement' => $lesEquipementsDunLogement,
            'idLogement'=>$idLogement,
            'lesCommentairesDunLogement' => $lesCommentairesDunLogement

        ]);
    }


      /**
     * @Route("/infoLogement/{idLogement}/{idOffre}/reservation", name="reservation")
     */
    public function reservation($idOffre,$idLogement,ReservationDuUserManager $rdum,EntityManagerInterface $om)
    {

      //l'offre choisi quand l'utilisateur était sur la liste des logements
      $uneOffre=$this->getDoctrine()->getRepository(OffreReservation::class)->findById($idOffre);

     /* foreach(lesOffres as uneOffre)
      {
        uneOffre
      }*/
      

      
      // avoir l'objet de l'user actuel
      $User= $this->getUser();
      // uneOffre est un tableau donc je lui dit de prendre l'indice 0 
      $rdum->addReservationDuUser($uneOffre[0],$User,$om);

      //pour afficher la nouvelle liste de service du user
    //  $lesServicesDuUser=$this->getDoctrine()->getRepository(ServiceDuUser::class)->findAll();
      return $this->redirectToRoute('mesReservations');
    }
}
