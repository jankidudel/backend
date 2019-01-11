<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;

/**
 * @ORM\Entity()
 */
class RegularUser extends User
{
    /**
     * RegularUser constructor.
     * @param $name
     * @param $userId
     */
    public function __construct($name, $userId) {
        parent::__construct($name, $userId);

        $this->role = parent::ROLE_REGULAR;
    }
}