<?php

declare(strict_types=1);

namespace App\Domain\Gateway;

use App\Domain\Entity\Movie;
use App\Domain\Entity\Paginator;
use App\Domain\Entity\Video;

interface MovieGateway
{
    public function findByPage(int $page = 1, array $criteria = []): Paginator;

    public function findById(int $id): ?Movie;

    /** @return Video[] */
    public function getVideos(int $id): array;
}
