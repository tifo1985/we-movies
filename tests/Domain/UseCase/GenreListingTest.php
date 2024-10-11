<?php

namespace App\Tests\Domain\UseCase;

use App\Domain\Entity\Genre;
use App\Domain\Gateway\GenreGateway;
use App\Domain\Response\GenreListingResponse;
use App\Domain\UseCase\GenreListing;
use PHPUnit\Framework\TestCase;

class GenreListingTest extends TestCase
{
    public function testExecuteReturnsGenreListingResponse()
    {
        $genres = [
            (new Genre())
            ->setId(1)
            ->setName('action'),
            (new Genre())
                ->setId(2)
                ->setName('comedy'),
        ];
        $genreGatewayMock = $this->createMock(GenreGateway::class);

        $genreGatewayMock->method('findAll')
            ->willReturn($genres);

        $genreListing = new GenreListing($genreGatewayMock);
        $response = $genreListing->execute();

        $this->assertInstanceOf(GenreListingResponse::class, $response);
        $this->assertEquals($genres, $response->getGenres());
    }
}