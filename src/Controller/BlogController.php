<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Entity\Commentaires;
use App\Entity\Categorie;
use App\Entity\Utilisateur;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index(PaginatorInterface $paginator, Request $request)
    {
        $repo=$this->getDoctrine() ->getRepository(Article::class);
        $articles=$paginator->paginate(
            $repo->findAll(),
            $request->query->getInt('page', 1), /*page number*/
             9 /*limit per page*/     );
            
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
        'articles'=>$articles
            ]);
    }
    /**
     * @Route("/show/{id}", name="show")
     */
    public function show($id)
    {
        $repo=$this->getDoctrine() ->getRepository(Article::class);
        $article=$repo->find($id);

        return $this->render('blog/show.html.twig', [
            'controller_name' => 'BlogController',
        'article'=>$article
            ]);
        }
    /**
     * @Route("/utilisateur", name="utilisateur")
     */
        
    public function utilisateur(Request $request, ObjectManager $manager)
    {
        $utilisateur =new Utilisateur();
        $form = $this->createFormBuilder($utilisateur)
        ->add('nom')
        ->add('prenom')
        ->add('date_naissance')
        ->add('mail')
        ->add('login')
        ->add('mot_passe')
        ->add('date_location')
        ->add('duree')
        ->add('fin_location')
        ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        $manager->persist($utilisateur); 
        $manager->flush();
        }


        return $this->render('blog/utilisateur.html.twig', [
            'formCreatUtilisateur' => $form->createView()
        ]);
        
    }
    /**
     * @Route("/article", name="article")
     */

    public function article(Request $request, ObjectManager $manager)
    {
        $art =new Article();
        $form = $this->createFormBuilder($art)
        ->add('title')
        ->add('content')
        ->add('image')
        ->add('createdAt')
        ->add('resume')
        //->add('categorie')

        ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        $manager->persist($art); 
        $manager->flush();
        }


        return $this->render('blog/article.html.twig', [
            'formArticle' => $form->createView()
        ]);

    }

    /**
     * @Route("/categorie", name="categorie")
     */

    public function categorie(Request $request, ObjectManager $manager)
    {
        $categorie =new Categorie();
        $form = $this->createFormBuilder($categorie)
        ->add('titre')
        ->add('resume')
        
        ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        $manager->persist($categorie); 
        $manager->flush();
        }


        return $this->render('blog/categorie.html.twig', [
            'formCategorie' => $form->createView()
        ]);        
        }

        /**
     * @Route("/commentaires", name="commentaires")
     */
    public function commentaires(Request $request, ObjectManager $manager)
    {
        $commentaires =new Commentaires();
        $form = $this->createFormBuilder($commentaires)
        ->add('auteur')
        ->add('commentaire')
        ->add('createdAt')
        //->add('article')
        
        ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        $manager->persist($commentaires); 
        $manager->flush();
        }


        return $this->render('blog/commentaires.html.twig', [
            'formCommentaires' => $form->createView()
        ]);
        
}
    
}

    


    


    


    


    


    


    

