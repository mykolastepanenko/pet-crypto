<?php

namespace App\Service;

use App\Service\Crypto\BtcUsdtInterface;

class BtcPricePrinter
{
    private BtcUsdtInterface $btc;

    public function __construct(BtcUsdtInterface $btc)
    {
        $this->btc = $btc;
    }

    public function getPrice(): float
    {
        return $this->btc->getPrice();
    }
}