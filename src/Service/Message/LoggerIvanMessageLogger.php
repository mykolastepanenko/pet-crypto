<?php

namespace App\Service\Message;

use Psr\Log\LoggerInterface;

class LoggerIvanMessageLogger implements IvanMessageLoggerInterface
{
    public function __construct(
        private readonly LoggerInterface $logger
    ){}
    public function log(string $message): void
    {
        $this->logger->info('IvanMessage processed', [
            'message' => $message
        ]);
    }
}