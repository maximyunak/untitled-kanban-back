<?php

namespace App\Services\KanbanService;

use App\DTOs\Kanban\BoardDTO;
use App\Models\Board;

class BoardService
{
    public function create_board(BoardDTO $dto): Board
    {
        return Board::create($dto->toArray());
    }
}
