<?php

namespace App\Service\Message;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Message;
use App\Repository\ChatRoomRepository;

class  SystemMessageSendingService implements MessageSendingStrategyInterface
{
    private $entityManager;
    private $chatRoomRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        ChatRoomRepository $chatRoomRepository
    ) {
        $this->entityManager = $entityManager;
        $this->chatRoomRepository = $chatRoomRepository;
    }

    public function sendToChatRooms(Message $message)
    {
        /*
         @todo: of course, looping and getting thousands of chats is not a good idea, to be refactored.
         I had thoughts to avoid attaching message to every chatRoom separately, however this would
         cause some issues when selecting all messages for a specific chat and if in the future
         we decide to filter-out some chats so they don't get system message
         (e.g system message for chat >= 5 users or warning for inactive chat about it's removal).
         Will probably need refactoring
        */
        $chatRooms = $this->chatRoomRepository->findAll();

        foreach ($chatRooms as $chatRoom)
        {
            $message->addChatRoom($chatRoom);
        }

        $currentDate = new \DateTime();
        // If time to send a message has arrived - set it as sent
        if ((new \Datetime()) >= $message->getSendAt()) {
            $message->setIsSent(true);
        }

        $this->entityManager->persist($message);
        // @todo: in this case flushing should be done every N messages.
        $this->entityManager->flush();
    }

    public function sendToUsersDirectly(Message $message)
    {
        // @todo: implement
    }

}