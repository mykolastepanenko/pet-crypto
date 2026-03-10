<?php

namespace App\Service\Crypto;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class CoinGeckoBtcPrice implements BtcUsdtPriceInterface
{
    public function __construct(
        private HttpClientInterface $httpClient
    ) {}

    public function getPrice(): float
    {
        $response = $this->httpClient->request(
            'GET',
            'https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=usd'
        );

        $data = $response->toArray();

        return (float) $data['bitcoin']['usd'];
    }
}