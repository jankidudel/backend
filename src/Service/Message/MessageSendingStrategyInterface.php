<?php

namespace App\Service\Message;

use App\Entity\Message;

interface MessageSendingStrategyInterface
{
    public function sendToChatRooms(Message $message);

    public function sendToUsersDirectly(Message $message);

}