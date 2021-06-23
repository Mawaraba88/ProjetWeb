<?php

namespace App\Controller;


use App\Entity\CategoryDonnees;
use App\Entity\Documenttype;
use App\Repository\CategoryDonneesRepository;

use App\Repository\DocumenttypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    private $repoDocumentType;
    private $repoCategory;

    public function __construct(DocumenttypeRepository $repoDocumentType, CategoryDonneesRepository  $repoCategory){
        $this->repoDocumentType = $repoDocumentType;
        $this->repoCategory = $repoCategory;

    }

    /**
     * @Route("/", name="home")
     */

    public function index(): Response
    {

        $categories =$this->repoCategory->findAll();

        $documents = $this->repoDocumentType->findAll();

        return $this->render('home/index.html.twig', [
            'documents' => $documents,
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/show/{id}", name="show")
     */


    public function show(Documenttype $document ): Response
    {
        //$document = $this->repoDocumentType->find($id);

       // dd($authors);
        if(!$document){
            return $this->redirectToRoute('home');
        }
        return $this->render('show/index.html.twig', [
            'document' => $document,

        ]);
    }

    /**
     * @Route("/showDocumenttypes/{id}", name="show_documenttype")
     */
    public function showDocumenttype(?CategoryDonnees $category ): Response
    {
    if($category){
        $documents = $category->getDocumenttypes()->getValues();
    }
    else{
       return  $this->redirectToRoute('home');
    }

        //dd($document);
        $categories = $this->repoCategory->findAll();
        return $this->render('home/index.html.twig', [
            'documents' => $documents,
            'categories' => $categories
        ]);
    }

}
