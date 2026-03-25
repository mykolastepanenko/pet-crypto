<?php

namespace App\Command;

use App\Message\BtcPriceNotification;
use App\Service\Crypto\BtcUsdtPriceInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;


#[AsCommand(
    name: 'app:btc-price',
    description: 'Show BTC price'
)]
class BtcUsdtPriceCommand extends Command
{
    public function __construct(
        private BtcUsdtPriceInterface $btcService,
        private MessageBusInterface   $bus
    )
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $price = $this->btcService->getPrice();
        $this->bus->dispatch(
            new BtcPriceNotification('BTC/USDT', $price)
        );
        $output->writeln("Dispatched BTC price: $price USDT");

        return Command::SUCCESS;
    }
}