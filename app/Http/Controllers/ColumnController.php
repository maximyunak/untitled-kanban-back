<?php

namespace App\Http\Controllers;

use App\DTOs\Kanban\Column\ColumnDTO;
use App\Http\Requests\Kanban\CreateColumnRequest;
use App\Models\Board;
use App\Models\Column;
use App\Services\KanbanService\ColumnService;

class ColumnController extends Controller
{
    public function __construct(private readonly ColumnService $columnService)
    {

    }

    public function index(Board $board)
    {
        $columns = Column::where("board_id", $board->id)->get();
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
