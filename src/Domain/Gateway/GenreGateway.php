<?php

declare(strict_types=1);

namespace App\Domain\Gateway;

use App\Domain\Entity\Genre;

interface GenreGateway
{
    /** @return Genre[]|array */
    public function findAll(): array;
}
