<?php

namespace App\Service\Notifier;

use App\ValueObject\TradingPair;
use Psr\Log\LoggerInterface;

class LoggerPriceNotifier implements PriceNotifierInterface
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    public function sendPrice(TradingPair $pair): void
    {
        $this->logger->info(
            'Sending price notification',
            ['pair' => (string) $pair]
        );
    }
}