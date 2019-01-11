<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class AdminUser extends User
{
    /**
     * AdminUser constructor.
     * @param $name
     * @param $userId
     */
    public function __construct($name, $userId) {
        parent::__construct($name, $userId);

        $this->role = parent::ROLE_ADMIN;
    }
}