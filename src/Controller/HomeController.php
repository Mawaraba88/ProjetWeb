<?php

namespace App\Controller;

use App\Entity\Documenttype;
use App\Repository\DocumenttypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    private $repoDocumentType;

    public function __construct(DocumenttypeRepository $repoDocumentType){
        $this->repoDocumentType = $repoDocumentType;

    }

    /**
     * @Route("/", name="home")
     */

    public function index(): Response
    {

        $documents = $this->repoDocumentType->findAll();

        return $this->render('home/index.html.twig', [
            'documents' => $documents,
        ]);
    }

    /**
     * @Route("/show/{id}", name="show")
     */


    public function show(Documenttype $document ): Response
    {
        //$document = $this->repoDocumentType->find($id);

        if(!$document){
            return $this->redirectToRoute('home');
        }
        return $this->render('show/index.html.twig', [
            'document' => $document,
        ]);
    }
}
