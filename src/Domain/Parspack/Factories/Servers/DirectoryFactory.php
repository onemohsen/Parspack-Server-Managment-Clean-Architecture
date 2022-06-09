<?php

declare(strict_types=1);


namespace Domain\Parspack\Factories\Servers;

use Domain\Parspack\Concerns\Interfaces\Server\SshInterface;
use Domain\Parspack\ValueObjects\Servers\DirectoryValueObject;

class DirectoryFactory
{
    public static function create(SshInterface $ssh, array $attributes): DirectoryValueObject
    {
        return new DirectoryValueObject(
            directory: $attributes['directory'],
            ssh: $ssh,
        );
    }
}
