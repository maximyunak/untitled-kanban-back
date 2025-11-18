<?php

namespace App\DTOs\Kanban\Board;

readonly class UpdateBoardDTO
{
    public function __construct(
        public ?string $name = null,
        public ?string $description = null,
    )
    {
    }

    public function toArray(): array
    {
        return array_filter([
            "name" => $this->name,
            "description" => $this->description,
        ], fn ($value) => $value !== null);
    }
}
