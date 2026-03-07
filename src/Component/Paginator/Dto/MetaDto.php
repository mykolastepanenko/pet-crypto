<?php

namespace App\Component\Paginator\Dto;

readonly class MetaDto
{
    public function __construct(
        private int $currentPage,
        private int $limit,
        private int $totalItems,
        private int $totalPages,
    ) {}

    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function getTotalItems(): int
    {
        return $this->totalItems;
    }

    public function getTotalPages(): int
    {
        return $this->totalPages;
    }
}
