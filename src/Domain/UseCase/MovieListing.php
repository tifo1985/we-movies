<?php

declare(strict_types=1);

namespace App\Domain\UseCase;

use App\Domain\Gateway\MovieGateway;
use App\Domain\Request\MovieListingRequest;
use App\Domain\Response\MovieListingResponse;

class MovieListing
{
    public function __construct(readonly private MovieGateway $movieGateway)
    {
    }

    public function execute(MovieListingRequest $movieListingRequest): MovieListingResponse
    {
        return new MovieListingResponse($this->movieGateway->findByPage(
            $movieListingRequest->getPage(),
            $movieListingRequest->getCriteria()
        ));
    }
}
