<?php

declare(strict_types=1);

namespace App\Domain\UseCase;

use App\Domain\Gateway\GenreGateway;
use App\Domain\Response\GenreListingResponse;

class GenreListing
{
    public function __construct(readonly private GenreGateway $genreGateway)
    {
    }

    public function execute(): GenreListingResponse
    {
        return new GenreListingResponse($this->genreGateway->findAll());
    }
}
