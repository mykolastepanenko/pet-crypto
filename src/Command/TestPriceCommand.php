<?php

namespace App\Command;

use App\Service\Notifier\LoggerPriceNotifier;
use App\ValueObject\TradingPair;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:test-price', description: 'Тест сервісу нотифікації')]
class TestPriceCommand extends Command
{
    public function __construct(
        private LoggerPriceNotifier $notifier
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $pair = new TradingPair('BTC', 'USDT');

        $this->notifier->sendPrice($pair);

        $output->writeln('<info>Повідомлення відправлено в лог!</info>');

        return Command::SUCCESS;
    }
}