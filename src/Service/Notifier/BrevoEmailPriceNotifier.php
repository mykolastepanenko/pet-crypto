<?php

namespace App\Service\Notifier;

use App\ValueObject\TradingPair;
use Symfony\Contracts\HttpClient\HttpClientInterface;

readonly class BrevoEmailPriceNotifier implements PriceNotifierInterface
{
    public function __construct(
        private HttpClientInterface $httpClient,
        private string $brevoApiKey,
        private string $adminEmail
    ) {}

    public function sendPrice(TradingPair $pair, float $price): void
    {
        $formattedPrice = number_format($price, 2, '.', ',');
        $pairName = "{$pair->getBase()}/{$pair->getQuote()}";

        $response = $this->httpClient->request('POST', 'https://api.brevo.com/v3/smtp/email', [
            'headers' => [
                'api-key' => $this->brevoApiKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'json' => [
                'sender' => [
                    'name' => 'Crypto Bot',
                    'email' => 'mykolaizzypetteam487@gmail.com'
                ],
                'to' => [
                    ['email' => $this->adminEmail]
                ],
                'subject' => "Ціна {$pairName}: {$formattedPrice}",
                'htmlContent' => "<h3>Крипто-сповіщення</h3><p>Пара <b>{$pairName}</b> зараз коштує <b>{$formattedPrice}</b></p>"
            ],
        ]);

        if ($response->getStatusCode() !== 201) {
            $error = $response->toArray(false);
            throw new \Exception("Brevo API Error: " . ($error['message'] ?? 'Invalid request'));
        }
    }
}