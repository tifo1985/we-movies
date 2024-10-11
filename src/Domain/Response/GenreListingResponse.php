<?php

declare(strict_types=1);

namespace App\Domain\Response;

class GenreListingResponse
{
    public function __construct(private readonly array $genres)
    {
    }

    public function getGenres(): array
    {
        return $this->genres;
    }
}
