<?php

namespace App\Http\Controllers\Kanban;

use App\DTOs\Kanban\BoardDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Kanban\CreateBoardRequest;
use App\Services\KanbanService\BoardService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    public function __construct(private readonly BoardService $boardService)
    {

    }

    public function store(CreateBoardRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data["user_id"] = auth()->id();

        $dto = new BoardDTO(...$data);
        $board = $this->boardService->create_board($dto);

        return $this->success(code: 201, message: "Successfully created board.", data: $board);
    }
}
