<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Entity\Commentaire;
use App\Entity\Categorie;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

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
             5 /*limit per page*/     );
            
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
}
