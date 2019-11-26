<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Categorie;

use App\Entity\Utilisateur;
use App\Entity\Commentaires;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class AdministrateurController extends AbstractController
{
    /**
     * @Route("/administrateur", name="administrateur")
     */
    public function index()
    {
        return $this->render('administrateur/index.html.twig', [
            'controller_name' => 'AdministrateurController',
        ]);
    }
    /**
     * @Route("/administrateur/article", name="admin.article")
     */
    public function article(PaginatorInterface $paginator, Request $request)
    {
        $repo=$this->getDoctrine() ->getRepository(Article::class);
        $articles=$paginator->paginate(
            $repo->findAll(),
            $request->query->getInt('page', 1), /*page number*/
             9 /*limit per page*/     );
            
        return $this->render('administrateur/article.html.twig', [
            'controller_name' => 'AdministrateurController',
        'articles'=>$articles
            ]);
    }

    /**
     * @Route("/administrateur/form/article", name="admin.form.article")
     */
    public function articleForm(Request $request, ObjectManager $manager)
    {
        $article =new Article();
        $form = $this->createFormBuilder($article)
        ->add('title')
        ->add('content')
        ->add('image')
        ->add('createdAt')
        ->add('resume')
        ->add('categorie', EntityType::class, [
            'class' => Categorie::class,
            "choice_label" => 'titre'
    ])
         
        ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        $manager->persist($article); 
        $manager->flush();
        }
        return $this->render('administrateur/artform.html.twig', [
            'formArticle' => $form->createView()
        ]);
    }


    /**
    * @Route("/administrateur/article/{id}", name="admin.article.modif")
    */
    
    public function modifArticle(Article $article, Request $request, ObjectManager $manager)
    {
        $form = $this->createFormBuilder($article)
        ->add('title')
        ->add('content')
        ->add('image')
        ->add('createdAt')
        ->add('resume')
        ->add('categorie', EntityType::class, [
            'class' => Categorie::class,
            "choice_label" => 'titre'
    ])
         
        ->getForm();
        $form->handleRequest($request);
                
        if($form->isSubMitted() && $form->isValid()){
            $manager->persist($article);
            $manager->flush();

            return $this->redirectToRoute('admin.article', 
            ['id'=>$article->getId()]); // Redirection vers l'article
        }
        return $this->render('administrateur/artmodif.html.twig', [
               'formModifArt' => $form->createView()
               ]);
    }



    /**
     * @Route("/administrateur/categorie", name="admin.categorie")
     */
    public function categorie(PaginatorInterface $paginator, Request $request)
    {
        $repos=$this->getDoctrine() ->getRepository(Categorie::class);
        $categories=$paginator->paginate(
            $repos->findAll(),
            $request->query->getInt('page', 1), /*page number*/
             9 /*limit per page*/     );
            
        return $this->render('administrateur/categorie.html.twig', [
            'controller_name' => 'AdministrateurController',
        'categories'=>$categories
            ]);
    }

    /**
     * @Route("/administrateur/form/categorie", name="admin.form.categorie")
     */
    public function categorieForm(Request $request, ObjectManager $manager)
    {
        $categorie = new Categorie();
        $form = $this->createFormBuilder($categorie)
                    ->add('titre')
                    ->add('resume')
                    ->getForm();

                    $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                $manager->persist($categorie); 
                $manager->flush();
        }
        return $this->render('administrateur/catform.html.twig', [
            'formCategorie' => $form->createView()
        ]);
    }

 /**
     * @Route("/administrateur/utilisateur", name="admin.utilisateur")
     */
    public function utilisateur(PaginatorInterface $paginator, Request $request)
    {
        $repo=$this->getDoctrine() ->getRepository(Utilisateur::class);
        $utilisateurs=$paginator->paginate(
            $repo->findAll(),
            $request->query->getInt('page', 1), /*page number*/
             9 /*limit per page*/     );
            
        return $this->render('administrateur/utilisateur.html.twig', [
            'controller_name' => 'AdministrateurController',
        'utilisateurs'=>$utilisateurs
            ]);
    }

    /**
     * @Route("/administrateur/form/utilisateur", name="admin.form.utilisateur")
     */
    public function utilisateurForm(Request $request, ObjectManager $manager)
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
        return $this->render('administrateur/utilform.html.twig', [
            'formUtilisateur' => $form->createView()
        ]);
    }
    
    

    

    
}
    
