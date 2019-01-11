<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="Message")
 * @ORM\Entity()
 */
class StandardMessage extends Message
{
    /**
     * StandardMessage constructor.
     * @param User $sender
     * @param $contentText
     */
    public function __construct(User $sender, $contentText)
    {
        parent::__construct($sender, $contentText);

        $this->setType(parent::TYPE_STANDARD);

        return $this;
    }
}