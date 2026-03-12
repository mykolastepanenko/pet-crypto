<?php

namespace App\Service\Crypto;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class BinanceBtcPrice implements BtcUsdtPriceInterface
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function getPrice(): float
    {
        $response = $this->httpClient->request(
            'GET',
            'https://api.binance.com/api/v3/ticker/price?symbol=BTCUSDT'
        );

        $data = $response->toArray();

        return (float) $data['price'];
    }
}