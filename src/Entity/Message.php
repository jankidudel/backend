<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MessageRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 */
abstract class Message
{
    const TYPE_STANDARD = 'standard';
    const TYPE_SYSTEM = 'system';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $contentText;

    /**
     * @ORM\Column(type="text")
     */
    private $type;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isSent = false;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    protected $sendAt;

    /**
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="sender_id", referencedColumnName="id")
     */
    private $sender;

    /**
     * Many Messages have Many ChatRooms
     * @ORM\ManyToMany(targetEntity="ChatRoom", inversedBy="messages")
     */
    private $chatRooms;

    /**
     * Message constructor.
     * @param User $sender
     * @param $contentText
     */
    public function __construct(User $sender, $contentText)
    {
        $this->sender = $sender;
        $this->contentText = $contentText;
        $this->chats = new ArrayCollection();
        $this->sendAt = new \Datetime();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getContentText()
    {
        return $this->contentText;
    }

    /**
     * @param $contentText
     * @return $this
     */
    public function setContentText($contentText)
    {
        $this->contentText = $contentText;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsSent()
    {
        return $this->isSent();
    }

    /**
     * @param $isSent
     * @return $this
     */
    public function setIsSent($isSent)
    {
        $this->isSent = $isSent;

        return $this;
    }

    /**
     * @return \Datetime
     */
    public function getSendAt()
    {
        return $this->sendAt;
    }

    /**
     * @param \Datetime $sendAt
     * @return $this
     */
    public function setSendAt(\Datetime $sendAt)
    {
        $this->sendAt = $sendAt;

        return $this;
    }

    /**
     * @return User
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @param User $sender
     * @return $this
     */
    public function setSender(User $sender)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getChatRooms()
    {
        return $this->chatRooms;
    }

    /**
     * @param ChatRoom $chatRoom
     * @return $this
     */
    public function addChatRoom(ChatRoom $chatRoom)
    {
        $this->chatRooms[] = $chatRoom;

        return $this;
    }
}
