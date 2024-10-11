<?php

namespace App\Domain\Request;

class MovieDetailsRequest
{
    public function __construct(private readonly int $id)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }
}
