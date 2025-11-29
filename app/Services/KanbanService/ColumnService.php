<?php

namespace App\Services\KanbanService;

use App\DTOs\Kanban\Column\ColumnDTO;
use App\DTOs\Kanban\Column\MoveColumnDTO;
use App\Models\Column;
use Illuminate\Support\Facades\DB;

class ColumnService
{
    public function create_column(ColumnDTO $dto): Column
    {
        return Column::create($dto->toArray());
    }

    public function move(MoveColumnDTO $dto): void
    {
        DB::transaction(function () use ($dto) {

            // Обновляем позиции всех колонок
            foreach ($dto->orderedColumns as $column) {
                Column::where('id', $column['id'])
                    ->where('board_id', $dto->boardId) // защита
                    ->update([
                        'position' => $column['position'],
                    ]);
            }

        });
    }
}
