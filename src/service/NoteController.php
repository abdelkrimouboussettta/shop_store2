<?php

namespace App\Controller;

use App\Service\Message;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class NoteController extends AbstractController
{
    /**
     * @Route("/note/add", name="add_note")
     */
    public function add(Message $message)
    {
        $students_note = $message->NoteMessage('10000', 'Ipalakot ');
        $this->addFlash('success', $students_note);
        
        return $this->render('note/index.html.twig', [
            'controller_name' => 'NoteController',
        ]);
    }
}
