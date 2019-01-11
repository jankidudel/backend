<?php

namespace App\Service\Message;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Message;

class StandardMessageSendingService implements MessageSendingStrategyInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function sendToChatRooms(Message $message)
    {
        $chatRooms = $message->getChatRooms();
        $senderUser = $message->getSender();
        foreach ($chatRooms as $chatRoom) {
            if (!$chatRoom->containsUser($senderUser)) {
                throw new \Exception('Message can be sent only from a user within chat !');
            }
            // @todo: in real world should be replaced with something more sophisticated.
            $message->setIsSent(true);
        }
        // persist message
        $this->entityManager->persist($message);
        $this->entityManager->flush();
    }

    public function sendToUsersDirectly(Message $message)
    {
        // @todo: implement
    }

}