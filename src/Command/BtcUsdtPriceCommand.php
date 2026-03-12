<?php

namespace App\Command;

use App\Service\Crypto\BtcUsdtPriceInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:btc-price',
    description: 'Show BTC price'
)]
class BtcUsdtPriceCommand extends Command
{
    public function __construct(
        private BtcUsdtPriceInterface $btcService
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $price = $this->btcService->getPrice();

        $output->writeln("BTC price: $price USDT");

        return Command::SUCCESS;
    }
}