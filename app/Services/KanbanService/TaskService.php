<?php

namespace App\Services\KanbanService;

use App\DTOs\Kanban\Task\MoveTaskDTO;
use App\DTOs\Kanban\Task\TaskDTO;
use App\DTOs\Kanban\Task\UpdateTaskDTO;
use App\Models\Board;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

class TaskService
{
    public function create(TaskDTO $dto)
    {
        $board = Task::create($dto->toArray());

        return $board;
    }

    public function move(MoveTaskDTO $dto)
    {
        DB::transaction(function () use ($dto) {

            // 1. Перемещаем саму задачу в колонку
            Task::where('id', $dto->movedTaskId)
                ->update([
                    'column_id' => $dto->toColumnId,
                ]);

            // 2. Обновляем позиции всех задач в колонке
            foreach ($dto->orderedTasks as $task) {
                Task::where('id', $task['id'])
                    ->update([
                        'position' => $task['position'],
                    ]);
            }

        });
    }

    public function update(Task $task, UpdateTaskDTO $dto): Task
    {
        $task->update($dto->data);

        return $task->fresh();
    }
}
