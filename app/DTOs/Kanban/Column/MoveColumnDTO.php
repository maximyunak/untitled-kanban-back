<?php

namespace App\DTOs\Kanban\Column;

class MoveColumnDTO
{
    public function __construct(
        public readonly int $boardId,
        public readonly int $movedColumnId,
        public readonly array $orderedColumns,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['board_id'],
            $data['moved_column_id'],
            $data['ordered_columns'],
        );
    }
}
