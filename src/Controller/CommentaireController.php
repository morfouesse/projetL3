<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\OffreReservation;
use App\Form\AddCommentaireType;
use App\Manager\CommentaireManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommentaireController extends AbstractController
{
    /**
     * @Route("/addCommentaire/{idLogement}", name="addCommentaire")
     */
    public function addCommentaire(EntityManagerInterface $manager,Request $request,CommentaireManager $cm,EntityManagerInterface $om,$idLogement)
    {
        
      
        $User= $this->getUser();

        $lesOffresReserverDunUser = $this->getDoctrine()->getRepository(OffreReservation::class)->findByUneReservationDunUser($User->getId());

        
        //on veut l'objet logement d'une reservation d'un user pour faire un commentaire
     
     
        foreach($lesOffresReserverDunUser as $uneOffre)
        {
            // l'id de la reservation d'un logement d'un user equivaut a l'id fournit en parametre de l'url alors on veut l'objet Logement
            if($uneOffre->getUneReservationDunLogement()->getId() == $idLogement) $Logement= $uneOffre->getUneReservationDunLogement();

            if($uneOffre->getUneReservationDunLogement()->getId() == $idLogement) $desOffre[] = $uneOffre;
         
        }

      

        $form= $this->createForm(AddCommentaireType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $data=$form->getData();
            $cm->addCommentaire($desOffre[0],$manager,$data,$User,$Logement,$om);
            return $this->redirectToRoute('mesCommentaires');
        }

       

        return $this->render('commentaire/ajoutCommentaire.html.twig', [
            'form' =>$form->createView(),
        ]);
    }


     /**
     * @Route("/mesCommentaires", name="mesCommentaires")
     */
    public function vosCommentaire()
    {

        $idUser = $this->getUser()->getId();
        $lesCommentairesDunUser = $this->getDoctrine()->getRepository(Commentaire::class)->findByLeCommentaireDunUser($idUser);


        return $this->render('commentaire/mesCommentaires.html.twig', [
            'lesCommentairesDunUser' =>$lesCommentairesDunUser,
        ]);
    }


      /**
     * @Route("/mesCommentaires/modif/{idCommentaire}", name="modifCommentaire")
     */
    public function modifCommentaire($idCommentaire,EntityManagerInterface $manager,Request $request,CommentaireManager $cm,EntityManagerInterface $om)
    {

        $lesCommentaires = $this->getDoctrine()->getRepository(Commentaire::class)->findById($idCommentaire);

        foreach($lesCommentaires as $unCommentaire)
        {
            if($unCommentaire->getId() == $idCommentaire) $leCommentaire = $unCommentaire;
        }


        $form= $this->createForm(AddCommentaireType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $data=$form->getData();
            $cm->modifCommentaire($leCommentaire,$manager,$data,$om);
            return $this->redirectToRoute('mesCommentaires');
        }

       // je met les commentaires, enfin le seul commentaire vers la vue pour donner les memes valeurs dans les champs
        return $this->render('commentaire/modifCommentaire.html.twig', [
            'form' =>$form->createView(),
            'lesCommentaires' => $lesCommentaires
        ]);
    }


      /**
     * @Route("/mesCommentaires/supp/{idCommentaire}", name="suppCommentaire")
     */
    public function suppCommentaire($idCommentaire,CommentaireManager $cm,EntityManagerInterface $om)
    {

      
        $lesCommentaires = $this->getDoctrine()->getRepository(Commentaire::class)->findById($idCommentaire);
        $lesOffresReserverDunUser = $this->getDoctrine()->getRepository(OffreReservation::class)->findByUnCommentaireDuneOffre($idCommentaire);

        foreach($lesCommentaires as $unComm)
        {
            if($unComm->getId() == $idCommentaire) $leCom = $unComm;
        }
        foreach($lesOffresReserverDunUser as $offre)
        {
            $uneOffre = $offre;
        }
     
            $cm->suppCommentaire($leCom,$uneOffre,$om);

            return $this->redirectToRoute('mesCommentaires');
        
    
        return $this->render('commentaire/mesCommentaires.html.twig');

    }

}
