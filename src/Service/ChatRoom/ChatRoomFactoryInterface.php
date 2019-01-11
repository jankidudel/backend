<?php

namespace App\Service\ChatRoom;

use App\Entity\ChatRoom;
use App\Entity\User;

interface ChatRoomFactoryInterface
{
    public function createChatRoom($name, User ...$users): ChatRoom;
}