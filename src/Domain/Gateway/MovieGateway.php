<?php

declare(strict_types=1);

namespace App\Domain\Gateway;

use App\Domain\Entity\Movie;
use App\Domain\Entity\Paginator;

interface MovieGateway
{
    public const MAX_ITEMS_PER_PAGE = 30;

    public function findByPage(int $page = 1): Paginator;

    public function findById(int $id): ?Movie;
}
