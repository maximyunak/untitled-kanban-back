<?php

namespace App\DTOs\Kanban\Task;

readonly class TaskDTO
{
    public function __construct(
        public string $name,
        public int    $position,

        public int $creator_id,
        public int $column_id,
    )
    {
    }

    public function toArray(): array
    {
        return [
            "name" => $this->name,
            "position" => $this->position,
            "creator_id" => $this->creator_id,
            "column_id" => $this->column_id,
        ];
    }
}
