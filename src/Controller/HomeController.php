<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;


class HomeController extends Controller
{
    /**
     * @Route("/accueil", name="accueil")
     */
        
    public function index(paginatorInterface $paginator, request $request)
    {
        $repo=$this->getDoctrine() ->getRepository(Article::class);
        $articles=$paginator->paginate(
            $repo->findAll(),
            $request->query->getInt('page', 1), /*page number*/
             9 /*limit per page*/     );
            
        return $this->render('home/index.html.twig', [
            'controller_name' => 'homeController',
        'articles'=>$articles
            ]);
    }
    /**
     * @Route("/propos", name="propos")
     */

    public function propos()
    {
        return $this->render('home/propos.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
/**
     * @Route("/contact", name="contact")
     */
        
    public function contact()
    {
        return $this->render('home/contact.html.twig', [
            'controller_name' => 'HomeController',
'age' => '30',
            ]);
    }

/**
     * @Route("/admin/admin", name="admin")
     */
        
    public function admin()
    {
        return $this->render('home/admin.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
            
}

