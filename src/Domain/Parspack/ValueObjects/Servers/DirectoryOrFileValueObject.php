<?php

declare(strict_types=1);

namespace Domain\Parspack\ValueObjects\Servers;

use Domain\Parspack\Concerns\Interfaces\Server\SshInterface;

class DirectoryOrFileValueObject
{
    public function __construct(
        public string $name,
        public SshInterface $ssh,
    ) {
    }

    public function toArray()
    {
        return [
            ...$this->name ? ['name' => $this->name] : [],
        ];
    }
}
