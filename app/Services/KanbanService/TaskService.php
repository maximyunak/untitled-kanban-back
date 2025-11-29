<?php

namespace App\Services\KanbanService;

use App\DTOs\Kanban\Task\TaskDTO;
use App\Models\Board;
use App\Models\Task;

class TaskService
{
    public function create(TaskDTO $dto)
    {
        $board = Task::create($dto->toArray());

        return $board;
    }
}
