<?php

namespace App\ValueObject;

readonly class TradingPair
{
    public function __construct(
        private string $base,
        private string $quote
    ) {}

    public function getBase(): string
    {
        return $this->base;
    }

    public function getQuote(): string
    {
        return $this->quote;
    }

}