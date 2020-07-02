<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\OffreReservation;
use Doctrine\ORM\EntityManagerInterface;
use App\Manager\ReservationDuUserManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReservationController extends AbstractController
{
    /**
     * @Route("/mesReservations", name="mesReservations")
     */
    public function mesReservations(ReservationDuUserManager $rdum,EntityManagerInterface $manager,EntityManagerInterface $om)
    {

        $idUser = $this->getUser()->getId();
        $lesOffresReserverDuUser = $this->getDoctrine()->getRepository(OffreReservation::class)->findByUneReservationDunUser($idUser);

        $lesCommentairesDunUser = $this->getDoctrine()->getRepository(Commentaire::class)->findByLeCommentaireDunUser($idUser);


        $lesOffreADate = $rdum->annulerReservationDate($lesOffresReserverDuUser,$manager,$om);
        $rdum->verifDatePasser($lesOffresReserverDuUser,$manager,$om);


        return $this->render('reservation/reservation.html.twig', [
            'lesOffresReserverDuUser' => $lesOffresReserverDuUser,
            'lesCommentairesDunUser' => $lesCommentairesDunUser,
            'lesOffreADate' => $lesOffreADate
        
        ]);
    }

    /**
     * @Route("/mesReservations/annulerUneReservation/{idOffre}", name="annulerReservation")
     */
    public function annulerUneReservation($idOffre,ReservationDuUserManager $rdum,EntityManagerInterface $om)
    {

        $User = $this->getUser();
        $lesOffresReserverDuUser=$this->getDoctrine()->getRepository(OffreReservation::class)->findById($idOffre);
     
        // on prend l'indice 0 car on veut un objet
        $rdum->delReservationDuUser($lesOffresReserverDuUser[0],$User,$om);

       
        return $this->redirectToRoute('mesReservations');
    }
}
