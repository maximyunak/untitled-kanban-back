<?php

namespace App\DTOs\Kanban;

readonly class BoardDTO
{
    public function __construct(
        public string  $name,
        public int     $user_id,
        public ?string $description = null,
    )
    {
    }

    public function toArray(): array
    {
        return [
            "name" => $this->name,
            "description" => $this->description,
            "user_id" => $this->user_id,
        ];
    }
}
