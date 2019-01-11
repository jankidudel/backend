<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Service\User\RegularUserFactory;
use App\Service\User\AdminUserFactory;
use App\Service\ChatRoom\ChatRoomFactory;
use App\Service\Message\StandardMessageFactory;
use App\Service\Message\SystemMessageFactory;
use App\Service\Message\StandardMessageSendingService;
use App\Service\Message\SystemMessageSendingService;

/**
 * Class RunCommand
 */
class RunCommand extends Command
{
    /**
     * Factory to create regular user
     * @var RegularUserFactory
     */
    private $regularUserFactory;

    /**
     * Factory to create admin user
     * @var AdminUserFactory
     */
    private $adminUserFactory;

    /**
     * Factory to create chat room
     * @var ChatRoomFactory
     */
    private $chatRoomFactory;

    /**
     * Factory to create standard message
     * @var StandardMessageFactory
     */
    private $standardMessageFactory;

    /**
     * Factory to create system message
     * @var SystemMessageFactory
     */
    private $systemMessageFactory;

    /**
     * Service to send standard messages
     * @var StandardMessageSendingService
     */
    private $standardMessageSendingService;

    /**
     * Service to send system message
     * @var SystemMessageSendingService
     */
    private $systemMessageSendingService;

    /**
     * RunCommand constructor.
     * @param RegularUserFactory $regularUserFactory
     * @param AdminUserFactory $adminUserFactory
     * @param ChatRoomFactory $chatRoomFactory
     * @param StandardMessageFactory $standardMessageFactory
     * @param SystemMessageFactory $systemMessageFactory
     * @param StandardMessageSendingService $standardMessageSendingService
     * @param SystemMessageSendingService $systemMessageSendingService
     */
    public function __construct(
        RegularUserFactory $regularUserFactory,
        AdminUserFactory $adminUserFactory,
        ChatRoomFactory $chatRoomFactory,
        StandardMessageFactory $standardMessageFactory,
        SystemMessageFactory $systemMessageFactory,
        StandardMessageSendingService $standardMessageSendingService,
        SystemMessageSendingService $systemMessageSendingService)
    {
        parent::__construct();

        $this->regularUserFactory = $regularUserFactory;
        $this->adminUserFactory = $adminUserFactory;
        $this->chatRoomFactory = $chatRoomFactory;
        $this->standardMessageFactory = $standardMessageFactory;
        $this->systemMessageFactory = $systemMessageFactory;
        $this->standardMessageSendingService = $standardMessageSendingService;
        $this->systemMessageSendingService = $systemMessageSendingService;
    }

    /**
     *
     */
    protected function configure()
    {
        $this
            ->setName('app:run')
            ->setDescription('Creates chats and sends some messages.')
            ->setHelp('This command allows to create test chats and send test messages')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Create 4 users: 3 regular and 1 admin
        $regularUser1 = $this->regularUserFactory->createUser('RegularUser-Name1', 'RegularUser-Id1');
        $regularUser2 = $this->regularUserFactory->createUser('RegularUser-Name2', 'RegularUser-Id2');
        $regularUser3 = $this->regularUserFactory->createUser('RregularUser-Name3', 'RegularUser-Id3');
        $adminUser1 = $this->adminUserFactory->createUser('AdminUser-Name1', 'AdminUser-Id1');


        // Create 2 chat rooms
        $chatRoom1 = $this->chatRoomFactory->createChatRoom('Chat-Name1', $regularUser1, $regularUser2);
        $chatRoom2 = $this->chatRoomFactory->createChatRoom('Chat-Name2', $regularUser3, $adminUser1);


        // Create 2 messages: one standard and one system
        $standardMessage1 = $this->standardMessageFactory->create($regularUser1, 'StandardMessage1-Text');
        $standardMessage1->addChatRoom($chatRoom1);

        // System instant message
        $systemMessage1 = $this->systemMessageFactory->create($adminUser1, 'SystemMessage1-Text');

        // System delayed message
        $systemMessage2 = $this->systemMessageFactory->create($adminUser1, 'SystemMessage2-Text');
        // Schedule to send system message +1 hour from now
        $systemMessage2->setSendAt(new \Datetime('now + 1 hour'));


        // (Sort of strategy pattern, because standard and system messages must be sent in a different way)
        $this->standardMessageSendingService->sendToChatRooms($standardMessage1);
        $this->systemMessageSendingService->sendToChatRooms($systemMessage1);
        $this->systemMessageSendingService->sendToChatRooms($systemMessage2);

        // @todo: Worker(ScheduledMessageSenderCommand) should run through unsent scheduled system messages.
    }
}