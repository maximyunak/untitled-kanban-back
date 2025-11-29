<?php

namespace App\DTOs\Kanban\Task;

class MoveTaskDTO
{
    public function __construct(
        public readonly int $movedTaskId,
        public readonly int $fromColumnId,
        public readonly int $toColumnId,
        public readonly array $orderedTasks,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['moved_task_id'],
            $data['from_column_id'],
            $data['to_column_id'],
            $data['ordered_tasks'],
        );
    }
}
