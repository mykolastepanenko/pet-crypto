<?php

namespace App\Message;

final class DirectMessage
{
    public function __construct(
        private readonly string $routingKey,
        private readonly string $payload,
    ) {
    }

    public function getRoutingKey(): string
    {
        return $this->routingKey;
    }

    public function getPayload(): string
    {
        return $this->payload;
    }
}

