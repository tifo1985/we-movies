<?php

namespace App\Domain\Request;

class MovieListingRequest
{
    public function __construct(
        private readonly int $page,
        private readonly array $criteria,
    ) {
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getCriteria(): array
    {
        return $this->criteria;
    }
}
