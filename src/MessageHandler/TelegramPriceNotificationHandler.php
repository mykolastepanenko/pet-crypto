<?php

namespace App\MessageHandler;

use App\Message\BtcPriceNotification;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler(fromTransport: 'telegram_price_notification_queue')]
class TelegramPriceNotificationHandler
{
    public function __construct(
        private readonly LoggerInterface $logger
    )
    {
    }

    public function __invoke(BtcPriceNotification $message): void
    {
        $this->logger->info('TELEGRAM notification', [
            'pair' => $message->getPair(),
            'price' => $message->getPrice(),
        ]);
    }
}
