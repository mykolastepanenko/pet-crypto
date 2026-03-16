<?php

namespace App\Message;

use Symfony\Component\Messenger\Attribute\AsMessage;

#[AsMessage('first_redis_queue')]
final readonly class FirstRedisMessage
{
    public function __construct(
        private string $name,
        private string $text,
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getText(): string
    {
        return $this->text;
    }
}
