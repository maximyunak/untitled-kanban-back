<?php

namespace App\Services\KanbanService;

use App\DTOs\Kanban\Board\BoardDTO;
use App\DTOs\Kanban\Board\UpdateBoardDTO;
use App\Models\Board;

class BoardService
{
    public function create_board(BoardDTO $dto): Board
    {
        return Board::create($dto->toArray());
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
