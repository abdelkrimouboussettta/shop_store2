<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;use App\Entity\Article;
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
     * @Route("/article", name="article")
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
    
}