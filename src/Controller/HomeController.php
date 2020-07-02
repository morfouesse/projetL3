<?php

namespace App\Controller;



use App\Entity\OffreReservation;
use App\Repository\LogementRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{
    /**
     * @Route("/accueil", name="accueil")
     */
    public function home(LogementRepository $lr,Request $nom)
    {

        $lesLogementsLesPlusReserver = $this->getDoctrine()->getRepository(OffreReservation::class)->findLesLogementsLesPlusReserver();

        
        

        return $this->render('Accueil.html.twig',array(
            'lesLogementsLesPlusReserver' => $lesLogementsLesPlusReserver
        ));
    }
}
