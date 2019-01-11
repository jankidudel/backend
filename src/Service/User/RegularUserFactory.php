<?php

namespace App\Service\User;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Entity\RegularUser;

class RegularUserFactory implements UserFactoryInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function createUser($name, $userId): User {
        $user = new RegularUser($name, $userId);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }

}