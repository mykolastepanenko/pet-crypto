<?php
namespace App\Service\Crypto;

interface BtcUsdtPriceInterface
{
    public function getPrice(): float;
}