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
        if (empty($this->brevoApiKey) || str_contains($this->brevoApiKey, 'replace_me')) {
            throw new \Exception("Помилка: API ключ Brevo не знайдено в оточенні (.env.local)");
        }

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
                    ['email' => $this->adminEmail, 'name' => 'Адмін'],
                    ['email' => 'vit11189@gmail.com', 'name' => 'Віталій'],
                    ['email' => 'ianamostuka@gmail.com', 'name' => 'Яна'],
                    ['email' => 'Nikolaua36@gmail.com', 'name' => 'Микола'],
                ],
                'subject' => "Ціна {$pairName}: {$formattedPrice}",
                'htmlContent' => "<h3>Привіт!</h3><p>Крипто-бот повідомляє, що ціна <b>{$pairName}</b> зараз <b>{$formattedPrice}</b>.</p>"
            ],
        ]);


        if ($response->getStatusCode() !== 201) {
            $errorData = $response->toArray(false);
            $message = $errorData['message'] ?? 'Unknown error';
            throw new \Exception("Brevo API Errmykolaizzypetteam487@gmail.comor ({$response->getStatusCode()}): " . $message);
        }
    }
}