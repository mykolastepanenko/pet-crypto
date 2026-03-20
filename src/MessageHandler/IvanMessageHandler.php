<?php

namespace App\MessageHandler;

use App\Message\IvanMessage;
use App\Service\Message\IvanMessageLoggerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class IvanMessageHandler
{
    public function __construct(
        private readonly IvanMessageLoggerInterface $logger
    ) {}

    public function __invoke(IvanMessage $message): void
    {
        $this->logger->log($message->getText());
    }
}