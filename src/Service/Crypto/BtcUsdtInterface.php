<?php
namespace App\Service\Crypto;

interface BtcUsdtInterface
{
    public function getPrice(): float;
}