<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
class SecurityController extends AbstractController
{
    /**
     * @Route("/security", name="security")
     */
    public function index()
    {
        return $this->render('security/index.html.twig', [
            'controller_name' => 'SecurityController',
        ]);
    }

    /**
     * @Route("/user", name="user")
     */
    public function user( )
    {
        $repo=$this->getDoctrine() ->getRepository(User::class);
        
            $user =$repo->findAll();
            
        return $this->render('security/user.html.twig', [
            'controller_name' => 'UserController'

            ]);
    }

    /**
     * @Route("/user/form/user", name="user.form")
     */
    public function userForm(Request $request, ObjectManager $manager)
    {
        $user =new User();
        $form = $this->createFormBuilder($user)
        ->add('nom')
        ->add('mail')
        ->add('login')
        ->add('passe_word')
        ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        $manager->persist($user); 
        $manager->flush();
        return $this->redirectToRoute('user', 
        ['id'=>$user->getId()]); 
        }
        return $this->render('security/userform.html.twig', [
            'formUser' => $form->createView()
        ]);
    }
    
    /**
    * @Route("/user/{id}", name="user.modif")
    */
    
    public function modifUser(user $user, Request $request, ObjectManager $manager)
    {
        $form = $this->createFormBuilder($user)
        ->add('nom')
        ->add('mail')
        ->add('login')
        ->add('pass_word')         
    
        ->getForm();
        $form->handleRequest($request);
                
        if($form->isSubMitted() && $form->isValid()){
        $manager->persist($user);
        $manager->flush();

        return $this->redirectToRoute('user', 
        ['id'=>$user->getId()]); 
        }
        return $this->render('security/usermodif.html.twig', [
        'formModifUser' => $form->createView()
        ]);
    }
    /**
    * @Route("/user/{id}/deletuser", name="user.sup")
    */
    
    public function supUser($id, ObjectManager $Manager, Request $request)
    {
        $repo = $this->getDoctrine()->getRepository(User::class);
        $user = $repo->find($id);

        $Manager->remove($user);
        $Manager->flush();
        
        return $this->redirectToRoute('user');
    }
    
    

    
}
    


