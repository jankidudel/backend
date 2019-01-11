<?php

namespace App\Service\User;

use App\Entity\User;

interface UserFactoryInterface
{
    public function createUser($name, $userId): User;
}