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
        return $this->render('administrateur/article.html.twig', [
            'formArticle' => $form->createView()
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
        $cat =new Categorie();
        $form = $this->createFormBuilder($cat)
        ->add('titre')
        ->add('resume')
        ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        $manager->persist($cat); 
        $manager->flush();
        }
        return $this->render('administrateur/categorie.html.twig', [
            'formCategorie' => $form->createView()
        ]);
    }
    
}
    
