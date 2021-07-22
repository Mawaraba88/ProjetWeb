<?php

namespace App\Controller;



use App\Classe\SearchNews;

use App\Entity\News;
use App\Form\NewsType;

use App\Form\SearchNewsType;
use App\Repository\NewsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @Route("/news")
 */
class NewsController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/", name="news_index", methods={"GET"})
     */
    public function index(NewsRepository $newsRepository): Response
    {
        return $this->render('news/index.html.twig', [
            'news' => $newsRepository->findAll(),
        ]);
    }

    /**
     * @Route ("/showNouvelles", name= "show_nouvelle")
     */
    public function showNews(Request $request):Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $news = $entityManager->getRepository(News::class)->findNewsByCriteria('Nouvelles');

        $search = new SearchNews();
        $form = $this->createForm( SearchNewsType::class , $search);

        //recuperation de la requete envoyé par url
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $news = $this->entityManager->getRepository(News::class)->findwithSearchNews($search);
        } else {
            //recuperation de tous les produits en passant par le repository de la classe en question
            $news = $this->entityManager->getRepository(News::class)->findNewsByCriteria('Nouvelles');

            return $this->render('news/show_nouvelles.html.twig', [
                'news' => $news,
                'form' =>$form->createView()

            ]);
        }
    }
    /**
     * @Route ("/showEvenements", name= "show_evenement")
     */
    public function showEven(Request $request):Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $news = $entityManager->getRepository(News::class)->findNewsByCriteria('Evénements');

        $search = new SearchNews();
        $form = $this->createForm(SearchNewsType::class, $search);

        //recuperation de la requete envoyé par url
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $news = $this->entityManager->getRepository(News::class)->findwithSearchNews($search);
        } else {
            //recuperation de tous les produits en passant par le repository de la classe en question
            $news = $this->entityManager->getRepository(News::class)->findNewsByCriteria('Evénements');


            return $this->render('news/show_evenements.html.twig', [
                'news' => $news,
                'form' =>$form->createView()

            ]);
        }
    }

    /**
     * @Route ("/showSeminaires", name= "show_seminaire")
     */
    public function showSeminaire(Request $request):Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $news = $entityManager->getRepository(News::class)->findNewsByCriteria('Séminaires');

        $search = new SearchNews();
        $form = $this->createForm(SearchNewsType::class, $search);

        //recuperation de la requete envoyé par url
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $news = $this->entityManager->getRepository(News::class)->findwithSearchNews($search);
        } else {
            //recuperation de tous les produits en passant par le repository de la classe en question
            $news = $this->entityManager->getRepository(News::class)->findNewsByCriteria('Séminaires');


            return $this->render('news/show_seminaires.html.twig', [
                'news' => $news,
                'form' =>$form->createView()

            ]);
        }
    }

    /**
     * @Route ("/showReunions", name= "show_reunion")
     */
    public function showReunion(Request $request):Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $reunions = $entityManager->getRepository(News::class)->findNewsByCriteria('Réunions');

        $search = new SearchNews();
        $form = $this->createForm(SearchNewsType::class, $search);

        //recuperation de la requete envoyé par url
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $reunions = $this->entityManager->getRepository(News::class)->findwithSearchNews($search);
        } else {
            //recuperation de tous les produits en passant par le repository de la classe en question
            $reunions = $this->entityManager->getRepository(News::class)->findNewsByCriteria('Réunions');


            return $this->render('news/show_reunions.html.twig', [
                'reunions' => $reunions,
                'form' =>$form->createView()

            ]);
        }
    }

    /**
     * @Route("/new", name="news_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $news = new News();
        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($news);
            $entityManager->flush();

            return $this->redirectToRoute('account');
        }

        return $this->render('news/new.html.twig', [
            'news' => $news,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="news_show", methods={"GET"})
     */
    public function show(News $news): Response
    {
        return $this->render('news/show.html.twig', [
            'news' => $news,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="news_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, News $news): Response
    {
        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('account');
        }

        return $this->render('news/edit.html.twig', [
            'news' => $news,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="news_delete", methods={"POST"})
     */
    public function delete(Request $request, News $news): Response
    {
        if ($this->isCsrfTokenValid('delete'.$news->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($news);
            $entityManager->flush();
        }

        return $this->redirectToRoute('account');
    }



}
