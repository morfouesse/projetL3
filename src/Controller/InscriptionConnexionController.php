<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\InscriptionType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class InscriptionConnexionController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscription(Request $request,EntityManagerInterface $manager,
    UserPasswordEncoderInterface $encoder)
    {

        $user = new User(); // créer une instance de classe User

        $form = $this->createForm(InscriptionType::class,$user); //utilise mon formulaire RegistrationType par rapport à mon objet user

        $form->handleRequest($request);//analyse la requete request

         // si le formulaires est soumis et que tout c'est champs sont valide
        if($form->isSubmitted() && $form->isValid())
        {
            $hash=$encoder->encodePassword($user, $user->getPassword()); //pour encoder, on specifie le user car sa encode par rapport au user
            
            $user->setPassword($hash); //je modifie ton password et je le remplace par le hash
            $user->addRole("ROLE_USER");
            $manager->persist($user); //faire persister dans le temps le user
            $manager->flush(); //capte le et fait le maintenant

            return $this->redirectToRoute('connexion');
        }
  



        return $this->render('inscription_connexion/inscription.html.twig',[
            'form' =>$form->createView()

        ]);
    }

     /**
     * @Route("/connexion", name="connexion")
     */
    public function login(AuthenticationUtils $authenticationUtils)  
    {
        $error= $authenticationUtils->getLastAuthenticationError();
        $lastUsername= $authenticationUtils->getLastUsername();
      
        return $this->render('inscription_connexion/connexion.html.twig',[

            'lastUsername' => $lastUsername,
            'error' => $error
        ]
    
        
    );

    }

     /**
     * @Route("/deconnexion", name="deconnexion")
     */
    public function logout()
    {
      
    }

}
