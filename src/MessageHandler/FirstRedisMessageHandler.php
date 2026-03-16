<?php

namespace App\MessageHandler;

use App\Message\FirstRedisMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class FirstRedisMessageHandler
{
    public function __invoke(FirstRedisMessage $message): void
    {
        dump($message);
    }
}
