<?php

namespace App\Http\Controllers\Kanban;

use App\DTOs\Kanban\Board\BoardDTO;
use App\DTOs\Kanban\Board\UpdateBoardDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Kanban\CreateBoardRequest;
use App\Http\Requests\Kanban\UpdateBoardRequest;
use App\Models\Board;
use App\Services\KanbanService\BoardService;
use Illuminate\Http\JsonResponse;
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

    public function destroy(Board $board): JsonResponse
    {
        Gate::authorize('delete', $board);

        $this->boardService->delete_board($board);

        return $this->success(message: "Successfully deleted board.");
    }

    public function update(UpdateBoardRequest $request, Board $board): JsonResponse
    {
        Gate::authorize('update', $board);

        $dto = new UpdateBoardDTO(...$request->validated());
        $this->boardService->update_board($board, $dto);

        return $this->success(message: "Successfully updated board.",data: $board);
    }

    public function show(Board $board): JsonResponse
    {
        return $this->success(data: $board);
    }
}
