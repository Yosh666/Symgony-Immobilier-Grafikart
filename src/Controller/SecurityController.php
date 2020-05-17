<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername= $authenticationUtils->getLastUsername();/*NOTES
        permet de récupérer le denrier pseudo tapé par l'utilisateur
        */
        //ASK vérifier si c pr cette page ou sur le navigateur


        return $this->render('security/login.html.twig', [
            'last_username'=>$lastUsername,
            'error'=>$error
        ]);    
    }
}
