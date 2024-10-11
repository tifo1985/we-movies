<?php

declare(strict_types=1);

namespace App\Domain\UseCase;

use App\Domain\Entity\Video;
use App\Domain\Gateway\MovieGateway;
use App\Domain\Request\MovieDetailsRequest;
use App\Domain\Response\MovieDetailsResponse;

class MovieDetails
{
    public function __construct(readonly private MovieGateway $movieGateway)
    {
    }

    public function execute(MovieDetailsRequest $movieDetailsRequest): MovieDetailsResponse
    {
        $movie = $this->movieGateway->findById($movieDetailsRequest->getId());

        $videos = array_filter(
            $this->movieGateway->getVideos($movieDetailsRequest->getId()),
            fn (Video $video) => !empty($video->getSite()
        ));
        if (!empty($videos)) {
            $movie->setVideo(array_shift($videos));
        }

        return new MovieDetailsResponse($movie);
    }
}
