<?php

namespace App\Http\Controllers\Kanban;

use App\DTOs\Kanban\Column\ColumnDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Kanban\CreateColumnRequest;
use App\Models\Board;
use App\Models\Column;
use App\Services\KanbanService\ColumnService;
use Illuminate\Support\Facades\Gate;

class ColumnController extends Controller
{
    public function __construct(private readonly ColumnService $columnService)
    {

    }

    public function index(Board $board)
    {
        Gate::authorize('view', $board);
        $columns = Column::where("board_id", $board->id)->get()->load('tasks');
        return $this->success(data: $columns);
    }

    public function store(CreateColumnRequest $request, Board $board)
    {
        $data = $request->validated();
        $data["board_id"] = $board->id;

        $column = $this->columnService->create_column(new ColumnDTO(...$data));

        return $this->success(code: 201, message: "Successfully created column.", data: $column);
    }
}
