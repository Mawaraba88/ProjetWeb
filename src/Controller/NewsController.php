<?php

namespace App\Controller;

use App\Entity\Documenttype;
use App\Form\NewsType;
use App\Repository\DocumenttypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/news")
 */
class NewsController extends AbstractController
{
    /**
     * @Route("/", name="news_index", methods={"GET"})
     */
    public function index(DocumenttypeRepository $documenttypeRepository): Response
    {
        return $this->render('news/index.html.twig', [
            'documenttypes' => $documenttypeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="news_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $documenttype = new Documenttype();
        $form = $this->createForm(NewsType::class, $documenttype);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user =$this->getUser();
            $documenttype->addAuthor($user);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($documenttype);
            $entityManager->flush();

            return $this->redirectToRoute('account');
        }

        return $this->render('news/new.html.twig', [
            'documenttype' => $documenttype,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="news_show", methods={"GET"})
     */
    public function show(Documenttype $documenttype): Response
    {
        return $this->render('news/show.html.twig', [
            'documenttype' => $documenttype,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="news_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Documenttype $documenttype): Response
    {
        $form = $this->createForm(NewsType::class, $documenttype);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('account');
        }

        return $this->render('news/edit.html.twig', [
            'documenttype' => $documenttype,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="news_delete", methods={"POST"})
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
}
