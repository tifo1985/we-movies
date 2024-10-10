<?php

declare(strict_types=1);

namespace App\Domain\Response;

use App\Domain\Entity\Paginator;

class MovieListingResponse
{
    public function __construct(private readonly Paginator $moviesPaginator)
    {
    }

    public function getMoviesPaginator(): Paginator
    {
        return $this->moviesPaginator;
    }
}
