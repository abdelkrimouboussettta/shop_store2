<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index()
    {
        $repo=$this->getDoctrine() ->getRepository(Article::class);
        $articles=$repo->findAll();

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
