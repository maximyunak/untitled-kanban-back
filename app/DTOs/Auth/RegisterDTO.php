<?php

namespace App\DTOs\Auth;

readonly class RegisterDTO
{
    public function __construct(
        public string  $first_name,
        public string  $last_name,
        public string  $email,
        public string  $password,
        public ?string $patronymic = null,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'patronymic' => $this->patronymic ?? null,
        ];
    }
}
