<?php

namespace App\Message\Event;

use Symfony\Component\Messenger\Attribute\AsMessage;

#[AsMessage('notifications')]
final readonly class UserRegistered
{
    public function __construct(
        private int $userId,
        private int $ts,
    ) {}

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getTs(): int
    {
        return $this->ts;
    }
}
