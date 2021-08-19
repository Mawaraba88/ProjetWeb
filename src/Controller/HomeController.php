<?php

namespace App\Controller;


use App\Entity\CategoryDonnees;
use App\Entity\CategoryNews;
use App\Entity\Documenttype;
use App\Entity\Header;
use App\Entity\News;
use App\Repository\CategoryDonneesRepository;

use App\Repository\CategoryNewsRepository;
use App\Repository\DocumenttypeRepository;
use App\Repository\NewsRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{

    private $repoDocumentType;
    private $repoCategoryDoc;
    private $repoCategoryNews;
    private $repoNewsType;
    private $entityManager;


    public function __construct(DocumenttypeRepository $repoDocumentType,
                                CategoryDonneesRepository  $repoCategoryDoc,
                                CategoryNewsRepository $repoCategoryNews,
                                NewsRepository $repoNewsType, EntityManagerInterface $entityManager){
        $this->repoDocumentType = $repoDocumentType;
        $this->repoCategoryDoc = $repoCategoryDoc;
        $this->repoCategoryNews = $repoCategoryNews;
        $this->repoNewsType = $repoNewsType;
        $this->entityManager = $entityManager;

    }

    /**
     * @Route("/", name="home")
     */

    public function index(): Response
    {

        $categories =$this->repoCategoryDoc->findAll();
        $categoryNews = $this->repoCategoryNews->findAll();


        //$documents = $this->repoDocumentType->findAll();
        /*$documents = $this->repoDocumentType->findByIsActive(1);
        $news = $this->repoNewsType->findByIsActive(1);*/
       /* $documents = $this->repoDocumentType->findBy([
            'isActive'=> true ],

            ['createdAt' => 'desc']
           );*/
        $documents = $this->entityManager->getRepository(Documenttype::class)->findwithDocuments('Articles');
       /* $news = $this->repoNewsType->findBy([
            'isActive'=> true],
            ['createdAt' => 'desc'
            ]);*/
        $news = $this->entityManager->getRepository(News::class)->findwithNews('Nouvelles');

        $events = $this->entityManager->getRepository(News::class)->findwithEventsAndSeminars('Evénements');
        $seminars = $this->entityManager->getRepository(News::class)->findwithEventsAndSeminars('Séminaires');
        $headers = $this->entityManager->getRepository(Header::class)->findAll();

        return $this->render('home/index.html.twig', [
            'documents' => $documents,
            'categories' => $categories,
            'categoryNews' => $categoryNews,
            'news' => $news,
            'events' => $events,
            'seminars' => $seminars,
            'headers' =>$headers
        ]);
    }

    /**
     * @Route("/showDocument/{id}", name="showDocument")
     */


    public function show(Documenttype $document ): Response
    {

        if(!$document){
            return $this->redirectToRoute('home');
        }
        return $this->render('show/indexDocument.html.twig', [
            'document' => $document,

        ]);
    }

    /**
     * @Route("/showNews/{id}", name="showNews")
     */


    public function showNews(News $news ): Response
    {

        if(!$news){
            return $this->redirectToRoute('home');
        }
        return $this->render('show/indexNews.html.twig', [
            'news' => $news,

        ]);
    }

    /**
     * @Route("/showDocumenttypes/{id}", name="show_documenttype")
     */
    public function showDocumenttype(?CategoryDonnees $categoryDoc ): Response
    {

    if($categoryDoc){

        $documents = $categoryDoc->getDocumenttypes()->getValues();
    }
    else{
       return  $this->redirectToRoute('home');
    }

        //dd($document);
        $categories = $this->repoCategoryDoc->findAll();
        return $this->render('home/index.html.twig', [
            'documents' => $documents,
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/showNewstypes/{id}", name="show_newstype")
     */
    public function showNewstype(?CategoryNews $categoryNews ): Response
    {

        if($categoryNews){

            $news = $categoryNews->getNewstypes()->getValues();
        }
        else{
            return  $this->redirectToRoute('home');
        }

        //dd($document);
        $categoryNews = $this->repoCategoryNews->findAll();
        return $this->render('home/index.html.twig', [
            'news' => $news,
            'categoryNews' => $categoryNews
        ]);
    }

}
