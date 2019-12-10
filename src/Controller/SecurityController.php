<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
 
 use Symfony\Component\HttpFoundation\Request;
 
class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }
    /**
     * @Route("/user/form/user", name="user.form")
     */
    public function userForm(Request $request, EntityManagerInterface $manager)
    {
        $user =new User();
        $form = $this->createFormBuilder($user)
        ->add('username')
        ->add('mail')
        ->add('login')
        ->add('password')
        ->add('roles')
        ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        $manager->persist($user); 
        $manager->flush();
        return $this->redirectToRoute('blog', 
        ['id'=>$user->getId()]); 
        }
        return $this->render('security/userform.html.twig', [
            'formUser' => $form->createView()
        ]);
    }
    
    
}
