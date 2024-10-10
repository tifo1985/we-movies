<?php

declare(strict_types=1);

namespace App\Domain\Response;

use App\Domain\Entity\Movie;

class MovieDetailsResponse
{
    public function __construct(private readonly ?Movie $movie)
    {
    }

    public function getMovie(): ?Movie
    {
        return $this->movie;
    }
}
