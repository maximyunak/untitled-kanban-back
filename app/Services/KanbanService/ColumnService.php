<?php

namespace App\Services\KanbanService;

use App\DTOs\Kanban\Column\ColumnDTO;
use App\Models\Column;

class ColumnService
{
    public function create_column(ColumnDTO $dto): Column
    {
        return Column::create($dto->toArray());
    }
}
