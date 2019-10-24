<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller
{
    /**
     * @Route("/accueil", name="accueil")
     */
        
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
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
     * @Route("/biens", name="biens")
     */
        
    public function biens()
    {
        return $this->render('home/biens.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
/**
     * @Route("/admin", name="admin")
     */
        
    public function admin()
    {
        return $this->render('home/admin.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
            
}

