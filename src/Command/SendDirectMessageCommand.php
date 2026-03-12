<?php

namespace App\Command;

use App\Message\DirectMessage;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(
    name: 'app:rabbitmq:example:dispatch',
    description: 'Dispatch a direct message asynchronously to RabbitMQ via the async Messenger transport',
)]
final class SendDirectMessageCommand extends Command
{
    public function __construct(
        private readonly MessageBusInterface $messageBus,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $routingKey = 'notification';
        $body = 'mykola test body!';

        $message = new DirectMessage($routingKey, $body);

        $this->messageBus->dispatch($message);

        $output->writeln(
            sprintf(
                'Dispatched DirectMessage to RabbitMQ. routing-key="%s", body="%s"',
                $routingKey,
                $body,
            ),
        );

        return Command::SUCCESS;
    }
}

