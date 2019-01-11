<?php

namespace App\Service\ChatRoom;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\ChatRoom;
use App\Entity\User;

class ChatRoomFactory implements ChatRoomFactoryInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function createChatRoom($name, User ...$users): ChatRoom {
        if (count($users) < 2) {
            // @todo: translate and subclass extension
            throw new \Exception('Number of users in chat should be no less than 2!');
        }

        $chatRoom = (new ChatRoom())
            ->setName($name);

        foreach ($users as $user) {
            $chatRoom->addUser($user);
        }

        $this->entityManager->persist($chatRoom);
        $this->entityManager->flush();

        return $chatRoom;
    }
}