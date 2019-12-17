<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\service;
class NoteController extends AbstractController
{
    /**
     * @Route("/note", name="note")
     */
    public function index(message $message)
    {
        return $this->render('note/index.html.twig', [
            'controller_name' => 'NoteController',
        ]);
    }
}
