<?php

namespace App\Command;

use App\Message\Event\UserRegistered;
use App\Service\User\Persistent\UserCreator;
use Faker\Factory;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(
    name: 'create:user',
    description: 'Create a new user',
)]
final class CreateUserCommand extends Command
{
    public function __construct(
        private readonly MessageBusInterface $messageBus,
        private readonly UserCreator $userCreator,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $batchSize = 100;

        for ($i = 0; $i < $batchSize; $i++) {
            $faker = Factory::create();
            $user = $this->userCreator->create($faker->name(), $faker->numberBetween(18, 100));
            $this->messageBus->dispatch(new UserRegistered($user->getId(), time()));

            $output->writeln($i + 1 . ' - Dispatched message to RabbitMQ');
        }

        return Command::SUCCESS;
    }
}

