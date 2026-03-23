<?php

namespace App\Command;

use App\Message\IvanMessage;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(
    name: 'app:ivan-message',
    description: 'Dispatch Ivan message'
)]
final class IvanMessageCommand extends Command
{
    public function __construct(
        private readonly MessageBusInterface $bus
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->bus->dispatch(new IvanMessage('Hello Ivan'));

        $output->writeln('Message dispatched');

        return Command::SUCCESS;
    }
}