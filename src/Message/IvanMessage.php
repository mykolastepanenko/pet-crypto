<?php
namespace App\Message;

Final class IvanMessage
    {
        public function __construct(
            private readonly string $text
        ){}
    public function getText(): string
    {
        return $this->text;
    }
}