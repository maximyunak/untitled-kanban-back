<?php

namespace App\Http\Controllers\Kanban;

use App\DTOs\Kanban\BoardDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Kanban\CreateBoardRequest;
use App\Models\Board;
use App\Services\KanbanService\BoardService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BoardController extends Controller
{
    public function __construct(private readonly BoardService $boardService)
    {

    }

    public function index()
    {
        $boards = Board::where("user_id", auth()->id())->get();

        return $this->success(data: $boards);
    }

    public function store(CreateBoardRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data["user_id"] = auth()->id();

        $dto = new BoardDTO(...$data);
        $board = $this->boardService->create_board($dto);

        return $this->success(code: 201, message: "Successfully created board.", data: $board);
    }

    public function destroy(Board $board)
    {
        Gate::authorize('delete', $board);
        
        $this->boardService->delete_board($board);

        return $this->success(message: "Successfully deleted board.");
    }
}
