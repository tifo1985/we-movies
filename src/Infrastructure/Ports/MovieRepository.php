<?php

declare(strict_types=1);

namespace App\Infrastructure\Ports;

use App\Domain\Entity\Movie;
use App\Domain\Entity\Paginator;
use App\Domain\Gateway\MovieGateway;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MovieRepository implements MovieGateway
{
    private const URI = '/3/discover/movie';
    private const URI_DETAILS_MOVIE = '/3/movie/';

    public function __construct(
        readonly private HttpClientInterface $themoviedbClient,
        readonly private SerializerInterface $serializer,
        readonly private LoggerInterface $logger,
    ) {
    }

    public function findByPage(int $page = 1): Paginator
    {
        try {
            $response = $this->themoviedbClient->request(
                Request::METHOD_GET,
                self::URI,
                [
                    'query' => [
                        'page' => $page,
                        'sort_by' => 'popularity.desc',
                        'with_genres' => '28',
                    ],
                ],
            );
            $responseAsArray = $response->toArray();

            return new Paginator(
                $this->serializer->denormalize($responseAsArray['results'], Movie::class.'[]'),
                $responseAsArray['total_results'],
                $page
            );
        } catch (\Throwable $exception) {
            $this->logger->critical('TMDB ERROR: '.$exception->getMessage());

            return new Paginator([], 0, $page);
        }
    }

    public function findById(int $id): ?Movie
    {
        try {
            $response = $this->themoviedbClient->request(
                Request::METHOD_GET,
                self::URI_DETAILS_MOVIE.$id,
            );

            return $this->serializer->denormalize($response->toArray(), Movie::class);
        } catch (\Throwable $exception) {
            $this->logger->critical('TMDB ERROR: '.$exception->getMessage());

            return null;
        }
    }
}
