<?php

declare(strict_types=1);

namespace Soccer\Api\Entity;

class Team
{
    public readonly int $id;
    public ?string $updatedAt;


    public function __construct(
        public readonly int $referalTeamId,
        public readonly ?string $name,
        public readonly ?string $country,
        public readonly ?string $logo,
        public ?string $createdAt,
    ) {
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}
