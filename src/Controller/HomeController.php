<?php

namespace App\Controller;

use App\Entity\Documenttype;
use App\Repository\DocumenttypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */


    public function index(): Response
    {

    $repo = $this->getDoctrine()->getRepository(Documenttype::class);
    $documents = $repo->findAll();

        return $this->render('home/index.html.twig', [
            'documents' => $documents,
        ]);
    }
}
