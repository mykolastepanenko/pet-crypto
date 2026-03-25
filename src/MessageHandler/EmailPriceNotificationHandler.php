<?php

namespace App\MessageHandler;

use App\Message\BtcPriceNotification;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler(fromTransport: 'email_price_notification_queue')]
class EmailPriceNotificationHandler
{
    public function __construct(
        private readonly LoggerInterface $logger
    )
    {
    }

    public function __invoke(BtcPriceNotification $message): void
    {
        $this->logger->info('EMAIL notification', [
            'pair' => $message->getPair(),
            'price' => $message->getPrice(),
        ]);
    }
}