<?php

namespace App\DTOs\Kanban\Task;

class UpdateTaskDTO
{
    public function __construct(
        public readonly array $data
    )
    {

    }

    public static function fromArray(array $data): self
    {
        return new self($data);
    }
}
