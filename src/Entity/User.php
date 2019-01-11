<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 */
abstract class User
{
    const ROLE_REGULAR = 'regular';
    const ROLE_ADMIN = 'admin';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
    * @ORM\Column(type="string")
    */
    private $name;

    /**
     * @ORM\Column(type="string");
     */
    private $userId;

    /**
     * Many Users have one Role
     * ORM\ManyToOne(targetEntity="Role", inversedBy="users")
     * ORM\JoinColumn(name="role_id", referencedColumnName="id")
     */

    /**
     * @ORM\Column(type="string");
     */
    protected $role;

    /**
     * Many Users have many ChatRooms
     * @ORM\ManyToMany(targetEntity="ChatRoom", mappedBy="users")
     */
    private $chatRooms;

    public function __construct($name, $userId)
    {
        $this->name = $name;
        $this->userId = $userId;
        $this->chatRooms = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getUserId()
    {
        return $this->getUserId();
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole(Role $role)
    {
        $this->role = $role;

        return $this;
    }

    public function getChatRooms()
    {
        return $this->chatRooms;
    }
}
