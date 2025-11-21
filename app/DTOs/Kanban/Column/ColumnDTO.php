<?php

namespace App\DTOs\Kanban\Column;

class ColumnDTO
{
    public function __construct(
        public string $name,
        public int    $board_id,
        public int    $position
    )
    {
    }

    public function toArray(): array
    {
        return [
            "name" => $this->name,
            "board_id" => $this->board_id,
            "position" => $this->position,
        ];
    }
}
