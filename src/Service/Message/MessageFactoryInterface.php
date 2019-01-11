<?php

namespace App\Service\Message;

use App\Entity\Message;
use App\Entity\User;

interface MessageFactoryInterface
{
    public function create(User $sender, $contentText): Message;
}