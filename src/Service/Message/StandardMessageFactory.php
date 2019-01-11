<?php

namespace App\Service\Message;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Message;
use App\Entity\StandardMessage;
use App\Entity\User;

class StandardMessageFactory implements MessageFactoryInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create(User $sender, $contentText): Message
    {
        $message = new StandardMessage($sender, $contentText);

        $this->entityManager->persist($message);
        $this->entityManager->flush();

        return $message;
    }
}