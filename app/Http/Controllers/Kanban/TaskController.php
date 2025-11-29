<?php

namespace App\Http\Controllers\Kanban;

use App\DTOs\Kanban\Task\MoveTaskDTO;
use App\DTOs\Kanban\Task\TaskDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Kanban\CreateTaskRequest;
use App\Http\Requests\Kanban\MoveTaskRequest;
use App\Models\Board;
use App\Models\Column;
use App\Services\KanbanService\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class TaskController extends Controller
{
    public function __construct(private readonly TaskService $taskService)
    {

    }

    public function store(Board $board, Column $column, CreateTaskRequest $request): JsonResponse
    {
        Gate::authorize("create", $board);
        $data = $request->validated();

        $data["column_id"] = $column->id;
        $data["creator_id"] = auth()->id();

        $dto = new TaskDTO(...$data);

        $task = $this->taskService->create($dto);

        return $this->success(code: 201, message: "Task successfully created", data: $task);
    }

    public function move(Board $board, MoveTaskRequest $request): JsonResponse
    {
        Gate::authorize("create", $board);

        $dto = MoveTaskDTO::fromArray($request->validated());

        $this->taskService->move($dto);

        return $this->success(message: "Task successfully moved");
    }
}
