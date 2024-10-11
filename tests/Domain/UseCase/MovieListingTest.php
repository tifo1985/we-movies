<?php

namespace App\Tests\Domain\UseCase;

use App\Domain\Entity\Movie;
use App\Domain\Entity\Paginator;
use App\Domain\Gateway\MovieGateway;
use App\Domain\Request\MovieListingRequest;
use App\Domain\Response\MovieListingResponse;
use App\Domain\UseCase\MovieListing;
use PHPUnit\Framework\TestCase;

class MovieListingTest extends TestCase
{
    public function testExecuteReturnsMovieListingResponse()
    {
        $paginator = new Paginator([
            (new Movie())
            ->setId(1)
            ->setTitle('title')
            ->setOverview('bla bla...'),
            (new Movie())
                ->setId(2)
                ->setTitle('title2')
                ->setOverview('bla bla2...'),
        ], 2, 1
        );

        $movieGatewayMock = $this->createMock(MovieGateway::class);

        $movieGatewayMock->method('findByPage')
            ->willReturn($paginator);

        $movieListingRequest = new MovieListingRequest(1, []);

        $movieListing = new MovieListing($movieGatewayMock);
        $response = $movieListing->execute($movieListingRequest);

        $this->assertInstanceOf(MovieListingResponse::class, $response);
        $this->assertEquals($paginator, $response->getMoviesPaginator());
    }
}