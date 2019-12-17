<?php

namespace App\Service;
use Psr\Log\LoggerInterface;

class Message
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    
    public function NoteMessage($note, $students)
    {
        $messages = 'Bjr' .$students. ' Votre note est: ' .$note ;

        $this->logger->info('Une note vous attends!');
        return $messages;
    }
}