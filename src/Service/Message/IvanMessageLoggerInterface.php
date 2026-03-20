<?php
namespace App\Service\Message;

interface IvanMessageLoggerInterface
{
    public function log(string $message): void;
}