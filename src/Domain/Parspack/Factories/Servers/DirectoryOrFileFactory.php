<?php

declare(strict_types=1);


namespace Domain\Parspack\Factories\Servers;

use Domain\Parspack\Concerns\Interfaces\Server\SshInterface;
use Domain\Parspack\ValueObjects\Servers\DirectoryOrFileValueObject;

class DirectoryOrFileFactory
{
    public static function create(SshInterface $ssh, array $attributes): DirectoryOrFileValueObject
    {
        return new DirectoryOrFileValueObject(
            name: $attributes['name'],
            ssh: $ssh,
        );
    }
}
