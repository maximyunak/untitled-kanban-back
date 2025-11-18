<?php

namespace App\Services\KanbanService;

use App\DTOs\Kanban\Board\BoardDTO;
use App\DTOs\Kanban\Board\UpdateBoardDTO;
use App\Models\Board;
use App\Models\UserBoard;

class BoardService
{
    public function create_board(BoardDTO $dto): Board
    {
        $board = Board::create($dto->toArray());

        UserBoard::create(["user_id" => $board->user_id, "board_id" => $board->id]);
        return $board;
    }

    public function delete_board(Board $board)
    {
        return $board->delete();
    }

    public function update_board(Board $board, UpdateBoardDTO $dto): Board
    {
        $board->update($dto->toArray());

        return $board;
    }
}
