<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Categorie;


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
     * @Route("/admin", name="administrateur")
     */
    public function index()
    {
        return $this->render('administrateur/index.html.twig', [
            'controller_name' => 'AdministrateurController',
        ]);
    }
    /**
     * @Route("/admin/article", name="admin.article")
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
     * @Route("/admin/form/article", name="admin.form.article")
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
        return $this->redirectToRoute('admin.article', 
        ['id'=>$article->getId()]); // Redirection vers
        }
        return $this->render('administrateur/artform.html.twig', [
            'formArticle' => $form->createView()
        ]);
    }


    /**
    * @Route("/admin/article/{id}", name="admin.article.modif")
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
    * @Route("/admin/article/{id}/deletart", name="admin.article.sup")
    */
    
    public function supArticle($id, ObjectManager $Manager, Request $request)
    {
        $repo = $this->getDoctrine()->getRepository(Article::class);
        $article = $repo->find($id);

        $Manager->remove($article);
        $Manager->flush();
        
        return $this->redirectToRoute('admin.article');
    }
    
 


    /**
     * @Route("/admin/categorie", name="admin.categorie")
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
     * @Route("/admin/form/categorie", name="admin.form.categorie")
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
        return $this->redirectToRoute('admin.categorie', 
        ['id'=>$categorie->getId()]); // Redirection vers
        }
        return $this->render('administrateur/catform.html.twig', [
            'formCategorie' => $form->createView()
        ]);
    }
    /**
    * @Route("/admin/categorie/{id}", name="admin.categorie.modif")
    */
    
    public function modifCategorie(categorie $categorie, Request $request, ObjectManager $manager)
    {
        $form = $this->createFormBuilder($categorie)
        ->add('titre')
        ->add('resume')
        ->getForm();
        $form->handleRequest($request);
                
        if($form->isSubMitted() && $form->isValid()){
        $manager->persist($categorie);
        $manager->flush();

        return $this->redirectToRoute('admin.categorie', 
        ['id'=>$categorie->getId()]); // Redirection vers l'article
        }
        return $this->render('administrateur/catmodif.html.twig', [
        'formModifCat' => $form->createView()
        ]);
    }
    /**
    * @Route("/admin/categorie/{id}/deletcat", name="admin.categorie.sup")
    */
    
    public function supCategorie($id, ObjectManager $Manager, Request $request)
    {
        $repo = $this->getDoctrine()->getRepository(Categorie::class);
        $categorie = $repo->find($id);

        $Manager->remove($categorie);
        $Manager->flush();
        
        return $this->redirectToRoute('admin.categorie');
    }
}