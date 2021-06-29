<?php

namespace App\Controller;

use App\Entity\Documenttype;
use App\Entity\Users;
use App\Form\DocumenttypeType;
use App\Repository\DocumenttypeRepository;
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
    /**
     * @Route("/", name="documenttype_index", methods={"GET"})
     */
    public function index(DocumenttypeRepository $documenttypeRepository): Response
    {
        return $this->render('documenttype/index.html.twig', [
            'documenttypes' => $documenttypeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="documenttype_new", methods={"GET","POST"})
     */
    public function new(Request $request /*SluggerInterface $slugger*/): Response
    {
        $documenttype = new Documenttype();
        $form = $this->createForm(DocumenttypeType::class, $documenttype);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /*/** @var UploadedFile $brochureFile */
            //$brochureFile = $form->get('brochure')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
           /* if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $brochureFile->move(
                        $this->getParameter('brochures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $documenttype->setBrochureFilename($newFilename);

            }*/
            $user =$this->getUser();
            $documenttype->addAuthor($user);
            $entityManager = $this->getDoctrine()->getManager();
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
     * @Route("/{id}", name="documenttype_show", methods={"GET"})
     */
    public function show(Documenttype $documenttype): Response
    {
        return $this->render('documenttype/show.html.twig', [
            'documenttype' => $documenttype,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="documenttype_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Documenttype $documenttype): Response
    {
        /*$documenttype->setBrochureFilename(
            new File($this->getParameter('images_directory').'/'.$documenttype->getBrochureFilename())
        );*/
        $form = $this->createForm(DocumenttypeType::class, $documenttype);
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
     * @Route("/{id}", name="documenttype_delete", methods={"POST"})
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
