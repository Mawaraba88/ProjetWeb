<?php

namespace App\Controller;

use App\Classe\Search;
use App\Entity\CategoryDonnees;
use App\Entity\CategoryNews;
use App\Entity\Documenttype;


use App\Entity\News;
use App\Form\DocumentsType;

use App\Form\SearchType;
use App\Repository\CategoryDonneesRepository;
use App\Repository\DocumenttypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/documenttype")
 */
class DocumenttypeController extends AbstractController
{
    private $repoCategory;
    private $entityManager;
    public function __construct( CategoryDonneesRepository  $repoCategory, EntityManagerInterface $entityManager){

        $this->repoCategory = $repoCategory;
        $this->entityManager = $entityManager;

    }

    /**
     * @Route("/home", name="documenttype_index", methods={"GET"})
     */
    public function index(/*DocumenttypeRepository $documenttypeRepository*/): Response
    {
        $documenttypes =  $this->getDoctrine()->getRepository(Documenttype::class)->findBy([
            'isActive'=> true],
            ['createdAt' => 'desc'
            ]);

        return $this->render('documenttype/index.html.twig', [
            //'documenttypes' => $documenttypeRepository->findAll(),
            'documenttypes' => $documenttypes

        ]);
    }

    /**
     * @Route ("/showCompteRendu", name= "show_compteRendu")
     */
    public function showCompteRendu(Request $request):Response
    {
        //die('toto');
        $entityManager = $this->getDoctrine()->getManager();
        $documentsTmp = $entityManager->getRepository(Documenttype::class)->findDocumentsByCriteria('Compte-Rendus');
        $documents = array();
        //pour passer un formulaire à twig
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);

        //recuperation de la requete envoyé par url
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $documentsTmp = $this->entityManager->getRepository(Documenttype::class)->findwithSearch($search, 'Compte-Rendus');
        }
        foreach ( $documentsTmp  as $document) {
            $dateJour = new \DateTime();
            $interval = $dateJour->diff($document->getCreatedAt());

            //die(var_dump($interval));
            if($interval->days > $document->getDurationOfPublication()) {
                // die(var_dump($document));
                $document->setIsActive(false);

            } else {
                $documents[] = $document;
            }
        }

        $entityManager->flush();


        //die(var_dump(count($documents)));
        return $this->render('documenttype/show_compte_rendus.html.twig', [
            'documents' => $documents,
            'form'=>$form->createView()

        ]);
    }

    /**
     * @Route ("/showPrototype", name= "show_prototype")
     */
    public function showPrototype(Request $request):Response
    {
        //die('toto');
        //die('toto');
        $entityManager = $this->getDoctrine()->getManager();
        $documentsTmp = $entityManager->getRepository(Documenttype::class)->findDocumentsByCriteria('Prototypes');
        $documents = array();
        //pour passer un formulaire à twig
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);

        //recuperation de la requete envoyé par url
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $documentsTmp = $this->entityManager->getRepository(Documenttype::class)->findwithSearch($search, 'Prototypes');
        }
        foreach ( $documentsTmp  as $document) {
            $dateJour = new \DateTime();
            $interval = $dateJour->diff($document->getCreatedAt());

            //die(var_dump($interval));
            if($interval->days > $document->getDurationOfPublication()) {
                // die(var_dump($document));
                $document->setIsActive(false);

            } else {
                $documents[] = $document;
            }
        }

        $entityManager->flush();

        return $this->render('documenttype/show_prototypes.html.twig', [
            'documents' => $documents,
            'form'=>$form->createView()

        ]);
    }
    /**
     * @Route ("/showRapport", name= "show_rapport")
     */
    public function showRapport(Request $request):Response
    {
        //die('toto');
        $entityManager = $this->getDoctrine()->getManager();
        $documentsTmp = $entityManager->getRepository(Documenttype::class)->findDocumentsByCriteria('Rapports');
        $documents = array();
        //pour passer un formulaire à twig
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);

        //recuperation de la requete envoyé par url
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $documentsTmp = $this->entityManager->getRepository(Documenttype::class)->findwithSearch($search, 'Rapports');
        }
        foreach ( $documentsTmp  as $document) {
            $dateJour = new \DateTime();
            $interval = $dateJour->diff($document->getCreatedAt());

            //die(var_dump($interval));
            if($interval->days > $document->getDurationOfPublication()) {
                // die(var_dump($document));
                $document->setIsActive(false);

            } else {
                $documents[] = $document;
            }
        }

        $entityManager->flush();

        return $this->render('documenttype/show_rapports.html.twig', [
            'documents' => $documents,
            'form'=>$form->createView()

        ]);
    }


/*
    /**
     * @Route ("/showArticle", name= "show_article")
     */
 /*   public function showArticle(Request $request):Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        //pour passer un formulaire à twig
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);



        $documents = $entityManager->getRepository(DocumentType::class)->findDocumentsByCriteria('Articles');

        //recuperation de la requete envoyé par url
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $documents = $this->entityManager->getRepository(Documenttype::class)->findwithSearch($search, 'Articles');
        }
        /*else{
            //recuperation de tous les produits en passant par le repository de la classe en question
            $documents = $this->entityManager->getRepository(Documenttype::class)->findDocumentsByCriteria('Articles');

        }



        //die(var_dump(count($documents)));
        return $this->render('documenttype/show_articles.html.twig', [
            'documents' => $documents,
            'form'=>$form->createView()

        ]);
    }*/

    /**
     * @Route ("/showArticle", name= "show_article")
     */
    public function showArticle(Request $request):Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $documentsTmp = $entityManager->getRepository(Documenttype::class)->findDocumentsByCriteria('Articles');
        $documents = array();
        //pour passer un formulaire à twig
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);

        //recuperation de la requete envoyé par url
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $documentsTmp = $this->entityManager->getRepository(Documenttype::class)->findwithSearch($search, 'Articles');
        }
        foreach ( $documentsTmp  as $document) {
            $dateJour = new \DateTime();
            $interval = $dateJour->diff($document->getCreatedAt());

            //die(var_dump($interval));
            if($interval->days > $document->getDurationOfPublication()) {
               // die(var_dump($document));
                $document->setIsActive(false);

            } else {
                $documents[] = $document;
            }
        }

        $entityManager->flush();


        //die(var_dump(count($documents)));
        return $this->render('documenttype/show_articles.html.twig', [
            'documents' => $documents,
            'form'=>$form->createView()

        ]);
    }


    /**
     * @Route("/new", name="documenttype_new", methods={"GET","POST"})
     */
    public function new(Request $request /*SluggerInterface $slugger*/): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $documenttype = new Documenttype();
        $form = $this->createForm(DocumentsType::class, $documenttype);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($documenttype->getCategorydonnees()->getName() == 'Articles') {
                $new = new News();
                $new->set($documenttype->getTitle());
                $new->setTitle($documenttype->getTitle());
                $new->setResume($documenttype->getResume());
                $new->setCreatedAt($documenttype->getCreatedAt());
                $categorynews = $entityManager->getRepository(CategoryNews::class)->findOneByName('Nouvelles');
                $new-> setCategorynews($categorynews);
                $entityManager->persist($new);

            }

            $entityManager->persist($documenttype);

            $entityManager->flush();

            return $this->redirectToRoute('account');
        }

        return $this->render('documenttype/new.html.twig', [
            'documenttype' => $documenttype,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/document/{id}", name="documenttype_show", methods={"GET"})
     */
    public function show(Documenttype $documenttype): Response
    {
        return $this->render('documenttype/show.html.twig', [
            'documenttype' => $documenttype,
        ]);
    }

    /**
     * @Route("/edit/{id}", name="documenttype_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Documenttype $documenttype): Response
    {

        $form = $this->createForm(DocumentsType::class, $documenttype);
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {


            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('account');
        }

        return $this->render('documenttype/edit.html.twig', [
            'documenttype' => $documenttype,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="documenttype_delete", methods={"POST"})
     */
    public function delete(Request $request, Documenttype $documenttype): Response
    {
        if ($this->isCsrfTokenValid('delete'.$documenttype->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($documenttype);
            $entityManager->flush();
        }

        return $this->redirectToRoute('account');
    }
/*
    /**
     * @Route("/showDocumenttypes/{id}", name="show_documenttype")
     */
    /*public function showDocumenttype(?CategoryDonnees $category ): Response
    {

        if($category){

            $documents = $category->getDocumenttypes()->getValues();
        }
        else{
            return  $this->redirectToRoute('home');
        }

        //dd($document);
        $categories = $this->repoCategory->findAll();
        return $this->render('documenttype/index.html.twig', [
            'documents' => $documents,
            'categories' => $categories
        ]);
    }*/

}
