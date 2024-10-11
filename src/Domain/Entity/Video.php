<?php

declare(strict_types=1);

namespace App\Domain\Entity;

class Video
{
    public const SUPPORTED_SITES = [
        'YouTube',
    ];

    private string $id;
    private ?string $site = null;
    private ?string $key = '';

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getSite(): ?string
    {
        return $this->site;
    }

    public function setSite(?string $site): self
    {
        if (in_array($site, self::SUPPORTED_SITES)) {
            $this->site = $site;
        }

        return $this;
    }

    public function getKey(): ?string
    {
        return $this->key;
    }

    public function setKey(?string $key): self
    {
        $this->key = $key;

        return $this;
    }
}
