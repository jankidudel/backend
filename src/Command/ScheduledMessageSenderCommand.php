<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


/**
 * Ideally this should be message worker,
 * in simplified version it could be run via CRON
 * Class ScheduledMessageSenderCommand
 */
class ScheduledMessageSenderCommand extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     *
     */
    protected function configure()
    {
        $this
            ->setName('app:send-scheduled-messages')
            ->setDescription('Send scheduled message when it\'s time is ready')
            ->setHelp('This command run through scheduled unsent messages and tries to send them')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // @todo: implement.
        // go through scheduled unsent messages ant if time is right - send them
    }
}