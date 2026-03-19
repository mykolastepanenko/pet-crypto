<?php

namespace App\Service\Notifier;

use App\ValueObject\TradingPair;
use Psr\Log\LoggerInterface;

readonly class LoggerPriceNotifier implements PriceNotifierInterface
{
    public function __construct(
        private LoggerInterface $logger
    ) {}

    public function sendPrice(TradingPair $pair, float $price): void
    {
        $this->logger->info('Sending price notification', [
            'base'       => $pair->getBase(),
            'quote'      => $pair->getQuote(),
            'full_pair'  => $pair->getBase() . '/' . $pair->getQuote(),
            'price'      => $price,
        ]);
    }
}