<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    /**
     * @Route("/register", name="security_register")
     */
    public function register(): Response
    {
        $user = new User();
        //Création du formulaire
        $form = $this->createForm(RegisterType::class, $user);

        //Affichage du formulaire
        return $this->render('security/index.html.twig', [
            'controller_name' => 'Inscription',
            'form' => $form->createView()
        ]);
    }
}
