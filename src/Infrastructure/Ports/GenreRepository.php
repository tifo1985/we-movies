<?php

declare(strict_types=1);

namespace App\Infrastructure\Ports;

use App\Domain\Entity\Genre;
use App\Domain\Gateway\GenreGateway;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class GenreRepository implements GenreGateway
{
    private const URI = '/3/genre/movie/list';

    public function __construct(
        readonly private HttpClientInterface $themoviedbClient,
        readonly private SerializerInterface $serializer,
        readonly private LoggerInterface $logger,
    ) {
    }

    public function findAll(): array
    {
        try {
            $response = $this->themoviedbClient->request(Request::METHOD_GET, self::URI);

            return $this->serializer->denormalize($response->toArray()['genres'], Genre::class.'[]');
        } catch (\Throwable $exception) {
            $this->logger->critical('TMDB ERROR: '.$exception->getMessage());

            return [];
        }
    }
}
