<?php

declare(strict_types=1);

namespace Soccer\Api\Entity;

class League
{
    public readonly int $id;
    public ?string $updatedAt;


    public function __construct(
        public readonly int $referalLeagueId,
        public readonly ?string $name,
        public readonly ?string $country,
        public readonly ?string $logo,
        public readonly ?string $flag,
        public ?string $createdAt,
    ) {
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}
