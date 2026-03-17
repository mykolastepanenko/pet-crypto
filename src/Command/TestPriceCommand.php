<?php

namespace App\Command;

use App\Service\Crypto\BtcUsdtPriceInterface;
use App\Service\Notifier\PriceNotifierInterface;
use App\ValueObject\TradingPair;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:test-price')]
class TestPriceCommand extends Command
{
    public function __construct(
        private BtcUsdtPriceInterface $priceProvider,
        private PriceNotifierInterface $notifier
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $pair = new TradingPair('BTC', 'USD');

        try {
            $price = $this->priceProvider->getPrice();
            $this->notifier->sendPrice($pair, $price);

            $output->writeln('<info>Success!</info>');
        } catch (\Exception $e) {
            $output->writeln('<error>' . $e->getMessage() . '</error>');
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}