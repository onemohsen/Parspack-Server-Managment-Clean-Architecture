<?php

declare(strict_types=1);

namespace Domain\Shared\ValueObjects;

class UserValueObject
{
    public function __construct(
        public string $name,
        public string $username,
        public string|null $email,
        public string|null $password = null,
    ) {
    }

    public function toArray()
    {
        return [
            ...$this->name ? ['name' => $this->name] : [],
            ...$this->username ? ['username' => $this->username] : [],
            ...$this->email ? ['email' => $this->email] : [],
            ...$this->password ? ['password' => $this->password] : [],
        ];
    }
}
