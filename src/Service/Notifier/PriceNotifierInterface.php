<?php


namespace App\Service\Notifier;

use App\ValueObject\TradingPair;

interface PriceNotifierInterface
{
    public function sendPrice(TradingPair $pair, float $price): void;
}