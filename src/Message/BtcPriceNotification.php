<?php

namespace App\Message;

final class BtcPriceNotification
{
    public function __construct(
        private readonly string $pair,
        private readonly float $price
    ){}
    public function getPair(): string
    {
        return $this->pair;
    }
    public function getPrice(): float
    {
        return $this->price;
    }
}