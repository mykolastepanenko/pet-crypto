<?php

namespace App\Service\Crypto;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class CoinGeckoBtcPrice implements BtcUsdtInterface
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
            'https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=usdt'
        );

        $data = $response->toArray();

        return (float) $data['bitcoin']['usdt'];
    }
}