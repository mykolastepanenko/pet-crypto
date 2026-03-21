<?php

namespace App\MessageHandler;

use App\Message\IvanMessage;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class IvanMessageHandler
{
    public function __construct(
        private readonly LoggerInterface $logger
    ) {}

    public function __invoke(IvanMessage $message): void
    {
        $this->logger->info('IvanMessage processed', [
            'message' => $message->getText()
        ]);
    }
}