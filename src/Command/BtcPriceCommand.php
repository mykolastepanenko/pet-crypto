<?php

namespace App\Command;

use App\Service\Crypto\BtcUsdtInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:btc-price',
    description: 'Shows current BTC price in USDT'
)]
class BtcPriceCommand extends Command
{
    private BtcUsdtInterface $btcService;

    public function __construct(BtcUsdtInterface $btcService)
    {
        parent::__construct();
        $this->btcService = $btcService;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $price = $this->btcService->getPrice();

        $output->writeln("BTC price: " . $price . " USDT");

        return Command::SUCCESS;
    }
}