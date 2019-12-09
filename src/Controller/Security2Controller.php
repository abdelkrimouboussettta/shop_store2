<?php

      

 namespace App\Controller;
 use App\Entity\User;
 use Knp\Component\Pager\PaginatorInterface;
 use Symfony\Component\HttpFoundation\Request;
 
 use Symfony\Component\Routing\Annotation\Route;
 use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 //use Doctrine\Common\Persistence\ObjectManager;
 use Doctrine\ORM\EntityManagerInterface;
class Security2Controller extends AbstractController
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
        
            $users =$repo->findAll();
            
        return $this->render('security/user.html.twig', [
            'controller_name' => 'UserController',
            'users' =>$users

            ]);
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
    
    /**
    * @Route("/user/{id}", name="user.modif")
    */
    
    public function modifUser(user $user, Request $request, EntityManagerInterface $manager)
    {
        $form = $this->createFormBuilder($user)
        ->add('usrname')
        ->add('mail')
        ->add('login')
        ->add('password')         
        ->add('roles')
    
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
    
    public function supUser($id, EntityManagerInterface $Manager, Request $request)
    {
        $repo = $this->getDoctrine()->getRepository(User::class);
        $user = $repo->find($id);

        $Manager->remove($user);
        $Manager->flush();
        
        return $this->redirectToRoute('user');
    }
    
}
    


