<?php

namespace App\Service\User;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Entity\AdminUser;

class AdminUserFactory implements UserFactoryInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function createUser($name, $userId): User {
        $user = new AdminUser($name, $userId);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;

    }
}