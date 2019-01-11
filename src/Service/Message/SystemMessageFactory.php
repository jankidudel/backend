<?php

namespace App\Service\Message;

use App\Entity\SystemMessage;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Message;
use App\Entity\User;
use App\Entity\AdminUser;

class SystemMessageFactory implements MessageFactoryInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function create(User $sender, $contentText): Message
    {
        if (!is_a($sender, AdminUser::class)) {
            throw new \Exception('Only admin can create system messages!');
        }

        $message = new SystemMessage($sender, $contentText);

        $this->entityManager->persist($message);
        $this->entityManager->flush();

        return $message;
    }
}