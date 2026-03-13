<?php

namespace App\Message;

final readonly class MyMessage
{
    public function __construct(
        private string $name,
        private string $age,
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getAge(): string
    {
        return $this->age;
    }
}

