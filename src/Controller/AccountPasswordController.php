<?php


namespace App\Controller;


use App\Form\ChangePasswordFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AccountPasswordController extends AbstractController
{
   /* private $entityManager;
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }


    /**
     * @Route("/account/modifier-mon-mot-de-passe", name="account_password")
     * @param Request $request
     * @param UserPasswordHasherInterface $encoder
     * @return \Symfony\Component\HttpFoundation\Response
     */
   /* public function index(Request $request, UserPasswordHasherInterface $encoder)
    {
        $notification = null;

        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordFormType::class, $user);
        //Pour manipuler la requete entrante
        $form ->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $old_pwd = $form->get('old_password')->getData();

            if($encoder->isPasswordValid($user, $old_pwd )){
                $new_pwd = $form->get('new_password')->getData();
                $password = $encoder->encodePassword($user, $new_pwd);
                $user->setPassword($password);

                $this->entityManager->flush();
                $notification = "Votre mot de pass a bien été mis à jour";
            }else{
                $notification = "Votre mot de passe actuel n'est pas le bon";
            }
        }
        return $this->render('account/password.html.twig', [
            'form' => $form->createView(),
            'notification' => $notification
        ]);
    }*/

}