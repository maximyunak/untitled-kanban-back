<?php

namespace App\DTOs\Auth;

class RegisterDTO
{
    public function __construct(
        public readonly string  $first_name,
        public readonly string  $last_name,
        public readonly ?string $patronymic,
        public readonly string  $email,
        public readonly string  $password,
    ) {}

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'patronymic' => $this->patronymic,
        ];
    }
}
