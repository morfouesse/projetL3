<?php

namespace App\Manager;

use App\Entity\Commentaire;
use Doctrine\Common\Collections\ArrayCollection;





class CommentaireManager
{
    public function addCommentaire($Offre,$manager,$data,$User,$Logement,$om){

        $Offre->getUnCommentaireDuneOffre()->setLeCommentaireDunUser($User);
        $Offre->getUnCommentaireDuneOffre()->setLeCommentaireDuLogement($Logement);
        $Offre->getUnCommentaireDuneOffre()->setTitreCommentaire($data->getTitreCommentaire());
        $Offre->getUnCommentaireDuneOffre()->setDescriptionCommentaire($data->getDescriptionCommentaire());
        $Offre->getUnCommentaireDuneOffre()->setNotationCommentaire($data->getNotationCommentaire());
        $manager->persist($Offre->getUnCommentaireDuneOffre());
        $om->flush();
        return $Offre->getUnCommentaireDuneOffre();  
    }

    public function modifCommentaire($leCommentaire,$manager,$data,$om){

        $leCommentaire->setTitreCommentaire($data->getTitreCommentaire());
        $leCommentaire->setDescriptionCommentaire($data->getDescriptionCommentaire());
        $leCommentaire->setNotationCommentaire($data->getNotationCommentaire());

        $manager->persist($leCommentaire);
        $om->flush();
        return $leCommentaire;  
    }


    public function suppCommentaire($leCom,$uneOffre,$om){

     
        $uneOffre->setUnCommentaireDuneOffre(NULL);
        $om->remove($leCom);
        $om->flush();
    
        return $uneOffre;  
    }

   
}