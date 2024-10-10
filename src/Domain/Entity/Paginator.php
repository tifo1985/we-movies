<?php

namespace App\Domain\Entity;

class Paginator
{
    public const ITEMS_PER_PAGE = 20;

    private int $currentPage;
    private int $totalItems;
    private int $totalPages;
    private array $items;

    public function __construct(array $items, int $totalItems, int $currentPage)
    {
        $this->items = $items;
        $this->totalItems = $totalItems;
        $this->currentPage = $currentPage;
        $this->totalPages = (int) ceil($totalItems / self::ITEMS_PER_PAGE);
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getTotalItems(): int
    {
        return $this->totalItems;
    }

    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    public function getTotalPages(): int
    {
        return $this->totalPages;
    }

    public function hasNextPage(): bool
    {
        return $this->currentPage < $this->totalPages;
    }

    public function hasPreviousPage(): bool
    {
        return $this->currentPage > 1;
    }

    public function getNextPage(): ?int
    {
        return $this->hasNextPage() ? $this->currentPage + 1 : null;
    }

    public function getPreviousPage(): ?int
    {
        return $this->hasPreviousPage() ? $this->currentPage - 1 : null;
    }
}
