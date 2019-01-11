<?php

namespace App\Service\Message;

use App\Entity\Message;

interface MessageSendingInterface
{
    public function sendToChatRooms(Message $message);

    public function sendToUsersDirectly(Message $message);
}