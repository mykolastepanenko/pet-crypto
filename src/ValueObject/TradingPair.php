<?php

namespace App\ValueObject;

readonly class TradingPair
{
    public function __construct(
        public string $base,
        public string $quote
    ) {}

    public function __toString(): string
    {
        return "{$this->base}/{$this->quote}";
    }
}