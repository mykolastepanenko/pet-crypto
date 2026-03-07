<?php

namespace App\Command;

use App\Service\User\Persistent\UserCreator;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:make-custom-user',
    description: 'Creates a custom user with name and age via service',
)]
class MakeCustomUserCommand extends Command
{
    private UserCreator $userCreator;

    public function __construct(UserCreator $userCreator)
    {
        parent::__construct();
        $this->userCreator = $userCreator;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('name', InputArgument::OPTIONAL, 'User name')
            ->addArgument('age', InputArgument::OPTIONAL, 'User age');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $name = $input->getArgument('name') ?: $io->ask('Enter user name');
        $age = (int) ($input->getArgument('age') ?: $io->ask('Enter user age', null, function ($age) {
            if (!is_numeric($age)) {
                throw new \RuntimeException('Age must be a number');
            }
            return $age;
        }));

        $user = $this->userCreator->create($name, $age);

        $io->success("User created: {$user->getName()}, age {$user->getAge()}");

        return Command::SUCCESS;
    }
}
