<?php

namespace App\Tests\Domain\UseCase;

use App\Domain\Entity\Movie;
use App\Domain\Entity\Video;
use App\Domain\Gateway\MovieGateway;
use App\Domain\Request\MovieDetailsRequest;
use App\Domain\Response\MovieDetailsResponse;
use App\Domain\UseCase\MovieDetails;
use PHPUnit\Framework\TestCase;

class MovieDetailsTest extends TestCase
{
    public function testExecuteReturnsMovieDetailsResponseWithVideo()
    {
        $movieGatewayMock = $this->createMock(MovieGateway::class);
        $movieDetailsRequest = new MovieDetailsRequest(1);

        $movie = (new Movie())
            ->setId(2)
            ->setTitle('title')
            ;
        $video = (new Video())
            ->setSite('YouTube');

        $movieGatewayMock->method('findById')
            ->willReturn($movie);

        $movieGatewayMock->method('getVideos')
            ->willReturn([$video]);

        $movieDetails = new MovieDetails($movieGatewayMock);

        $response = $movieDetails->execute($movieDetailsRequest);

        $this->assertInstanceOf(MovieDetailsResponse::class, $response);
        $this->assertEquals($movie, $response->getMovie());
        $this->assertEquals($video, $response->getMovie()->getVideo());
    }

    public function testExecuteReturnsMovieDetailsResponseWithoutVideo()
    {
        $movieGatewayMock = $this->createMock(MovieGateway::class);
        $movieDetailsRequest = new MovieDetailsRequest(1);

        $movie = (new Movie())
            ->setId(2)
            ->setTitle('title')
        ;

        $movieGatewayMock->method('findById')
            ->willReturn($movie);

        $movieGatewayMock->method('getVideos')
            ->willReturn([]);

        $movieDetails = new MovieDetails($movieGatewayMock);

        $response = $movieDetails->execute($movieDetailsRequest);

        $this->assertInstanceOf(MovieDetailsResponse::class, $response);
        $this->assertEquals($movie, $response->getMovie());
        $this->assertEquals(null, $response->getMovie()->getVideo());
    }

    public function testExecuteReturnsMovieDetailsResponseWithInvalidVideo()
    {
        $movieGatewayMock = $this->createMock(MovieGateway::class);
        $movieDetailsRequest = new MovieDetailsRequest(1);

        $movie = (new Movie())
            ->setId(2)
            ->setTitle('title')
        ;
        $video = (new Video())
            ->setSite('Invalid Site');

        $movieGatewayMock->method('findById')
            ->willReturn($movie);

        $movieGatewayMock->method('getVideos')
            ->willReturn([$video]);

        $movieDetails = new MovieDetails($movieGatewayMock);

        $response = $movieDetails->execute($movieDetailsRequest);

        $this->assertInstanceOf(MovieDetailsResponse::class, $response);
        $this->assertEquals($movie, $response->getMovie());
        $this->assertEquals(null, $response->getMovie()->getVideo());
    }
}