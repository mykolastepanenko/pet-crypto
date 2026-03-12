<?php

namespace App\Service;

use App\Service\Crypto\BtcUsdtPriceInterface;

class BtcPricePrinter
{
    public function __construct(private BtcUsdtPriceInterface $btc)
    {
    }

    public function getPrice(): float
    {
        return $this->btc->getPrice();
    }
}