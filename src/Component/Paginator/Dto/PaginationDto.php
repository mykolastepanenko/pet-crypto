<?php

namespace App\Component\Paginator\Dto;

final readonly class PaginationDto
{
    public function __construct(
        private array $items,
        private MetaDto $meta,
    ) {}

    public function getItems(): array
    {
        return $this->items;
    }

    public function getMeta(): MetaDto
    {
        return $this->meta;
    }
}
