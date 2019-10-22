<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlocController extends AbstractController
{
    /**
     * @Route("/bloc", name="bloc")
     */
    public function index()
    {
        return $this->render('bloc/index.html.twig', [
            'controller_name' => 'BlocController',
        ]);
    }
}
