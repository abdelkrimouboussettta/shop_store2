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
use Symfony\Component\Form\Extension\Core\Type\DateType;

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
    public function show($id, Request $request, ObjectManager $manager)
    {
        $repo=$this->getDoctrine() ->getRepository(Article::class);
        $article=$repo->find($id);
        
        $com =new Commentaires();

        $form = $this->createFormBuilder($com)
        ->add('auteur')
        ->add('commentaire')
        
        ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if(!$com->getId()) {
                $com->setCreatedAt(new \DateTime());
            }
            $com->setArticle($article);
            $manager->persist($com);
            $manager->flush();
    
            
                
        }

 return $this->render('blog/show.html.twig', [
    'article'=> $article,
    'formCommentaires' => $form ->createView()
    
    
]);
 }
 }