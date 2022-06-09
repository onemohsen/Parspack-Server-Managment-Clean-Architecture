<?php

declare(strict_types=1);

namespace Domain\Parspack\ValueObjects\Servers;

use Domain\Parspack\Concerns\Interfaces\Server\SshInterface;

class DirectoryValueObject
{
    public function __construct(
        public string $directory,
        public SshInterface $ssh,
    ) {
    }

    public function toArray()
    {
        return [
            ...$this->directory ? ['directory' => $this->directory] : [],
        ];
    }
}
